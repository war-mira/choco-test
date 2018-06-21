<?php

namespace App\Http\Controllers;

use Telegram;
use App\Doctor;
use App\City;
use App\Skill;
use Cache;
use Storage;

class TelegramBotController extends Controller
{
    /**
     * BotController constructor.
     */
    public function __construct()
    {
        Telegram::setAccessToken(
            env('DOCTORS_TELEGRAM_BOT_TOKEN')
        );
    }

    /**
     * Return bot information.
     * @return \Telegram\Bot\Objects\User
     */
    public function info()
    {
        return Telegram::getMe();
    }

    /**
     * Set webhook.
     * @return \Telegram\Bot\TelegramResponse
     */
    public function setWebhook()
    {
        $response = Telegram::setWebhook(
            ['url' => env('DOCTORS_TELEGRAM_BOT_URL')]
        );

        return !is_bool($response->getResult())
            ? $response : ['status' => true];
    }

    /**
     * Remove webhook.
     * @return \Telegram\Bot\TelegramResponse
     */
    public function removeWebhook()
    {
        $response = Telegram::removeWebhook(
            ['url' => env('DOCTORS_TELEGRAM_BOT_URL')]
        );

        return !is_bool($response->getResult())
            ? $response->getResult() : ['status' => true];
    }

    /**
     * Processing telegram request.
     * @return \Telegram\Bot\Objects\Message
     */
    public function callback()
    {
        // Telegram get response data.
        $chat = $this->getMessageChat();
        $text = $this->getMessageText();
        $photo = $this->getMessagePhoto();

        // Save photo to local storage.
        if (!empty($photo)) {
            $text = '/images/' . md5($photo . $chat) . '.'
                . pathinfo($photo, PATHINFO_EXTENSION);

            Storage::disk('local')->put(
                $text, file_get_contents($photo)
            );
        }

        // Get defaults list.
        $defaults = json_decode(
            file_get_contents(
                resource_path('/telegram/form.json')
            )
        );

        // Get chat data from local cache.
        $answers = Cache::get('tg_bot_' . $chat, []);

        // Get data counts.
        $answersCount = count($answers);
        $questionsCount = count(
            $defaults->questions
        );

        // Send bot message info.
        if ($text == '/start') {
            Cache::forget('tg_bot_' . $chat);

            return $this->sendMessage(
                $chat, $defaults->actions->start
            );
        }

        // Clear cache and send first question.
        if ($text == '/new') {
            Cache::forget('tg_bot_' . $chat);

            return $this->sendMessage(
                $chat, $defaults->questions[0]
            );
        }

        // If user already completed the form.
        if ($answersCount == $questionsCount) {
            return $this->sendMessage(
                $chat, $defaults->actions->success
            );
        }

        // Process response and send new message.
        if ($answersCount < $questionsCount) {
            // If current answer is last.
            $formCur = $defaults->questions[$answersCount];
            $formNew = ($answersCount + 1 == $questionsCount) ?
                $defaults->actions->success : $defaults->questions[$answersCount + 1];

            // Validate text data.
            if (isset($formCur->validator)) {
                $text = $this->{'validate' . ucfirst($formCur->validator)}($text, $formCur);
                if ($text === false) {
                    return $this->sendMessage($chat, $formCur, true);
                }
            }
            $answers[] = $text;

            // On success save form
            if($answersCount + 1 == $questionsCount) {
                $url = $this->save($answers, $defaults->questions);

                $success = $defaults->actions->success;
                $success->text = "Страница: " . $url . PHP_EOL
                    . $success->text;

                $formNew = $success;
            }

            // Set data to cache.
            Cache::put('tg_bot_' . $chat, $answers, 30);

            // Sen new question to chat.
            return $this->sendMessage($chat, $formNew);
        }
    }

    /**
     * @param $chat
     * @param $form
     * @param bool $error
     * @return \Telegram\Bot\Objects\Message
     */
    private function sendMessage($chat, $form, $error = false)
    {
        $reply_markup = '';

        if (isset($form->type) && $form->type == 'select') {
            $reply_markup = Telegram::replyKeyboardMarkup([
                'keyboard' => array_chunk($form->fields, 2),
                'resize_keyboard' => true,
                'one_time_keyboard' => true
            ]);
        }

        return Telegram::sendMessage([
            'chat_id' => $chat,
            'text' => (!$error) ? $form->text : $form->error,
            'reply_markup' => $reply_markup
        ]);
    }

    /**
     * Telegram message get chat id.
     * @return string
     */
    private function getMessageChat()
    {
        $update = Telegram::getWebhookUpdates();
        if ($update->getMessage() !== null) {
            return $update->getMessage()->getChat()->getId();
        }
    }

    /**
     * Telegram message text.
     * @return string
     */
    private function getMessageText()
    {
        $update = Telegram::getWebhookUpdates();
        if ($update->getMessage() !== null && $update->getMessage()->has('text')) {
            return $update->getMessage()->getText();
        }
    }

    /**
     * Telegram message get photo url.
     * @return string
     */
    private function getMessagePhoto()
    {
        $update = Telegram::getWebhookUpdates();
        if ($update->getMessage() !== null && $update->getMessage()->has('photo')) {
            $photo = $update->getMessage()->getPhoto()
                    [sizeof($update->getMessage()->getPhoto()) - 1]['file_id'];
            $photo = Telegram::getFile(['file_id' => $photo]);

            return 'https://api.telegram.org/file/bot' . env('DOCTORS_TELEGRAM_BOT_TOKEN') . '/' . $photo->getFilePath();
        }
    }

    /**
     * Validate phone number.
     * @param $string
     * @return bool|mixed
     */
    private function validatePhone($string, $form)
    {
        $string = preg_replace(
            '~\D~', '', $string
        );

        return (strlen($string) == 11) ? $string : false;
    }

    /**
     * Validate string.
     * @param $string
     * @return bool
     */
    private function validateString($string, $form)
    {
        $string = trim($string);

        return !empty($string) ? $string : false;
    }

    /**
     * Validate field.
     * @param $string
     * @param $form
     * @return bool|string
     */
    private function validateField($string, $form)
    {
        $string = trim($string);

        return in_array($string, $form->fields)
            ? $string : false;
    }

    /**
     * Validate photo.
     * @param $path
     * @param $form
     * @return bool|string
     */
    private function validateImage($path, $form)
    {
        return Storage::disk('local')->has($path)
            ? $path : false;
    }

    /**
     * Validate name.
     * @param $string
     * @param $form
     * @return bool|string
     */
    private function validateName($string, $form)
    {
        $parts = explode(' ', trim($string));

        return count($parts) == 3 ? $string : false;
    }

    /**
     * Validate year.
     * @param $string
     * @param $form
     * @return bool|string
     */
    private function validateYear($string, $form)
    {
        $string = (int) $string;
        if($string > 1950 && $string <= date('Y'))
        {
            return $string . '-01-01';
        }

        return false;
    }

    /**
     * Validate price.
     * @param $string
     * @param $form
     * @return bool|int
     */
    private function validatePrice($string, $form)
    {
        return (int) $string;
    }

    /**
     * Save data.
     * @param $answers
     * @param $questions
     * @return bool
     */
    private function save($answers, $questions)
    {
        $fields = [];
        foreach ($answers as $key => $answer) {
            $fields[$questions[$key]->name] = $answer;
        }
        $fio = explode(" ", $fields['name']);

        $dateTime = new \DateTime($fields['year']);
        $fields['works_since_unix'] = $dateTime->format('U');
        $fields['works_since'] = $fields['year'];

        $city = City::where(
            'name', '=', $fields['city']
        )->first();

        $skill = Skill::where(
            'name', '=', $fields['specialization']
        )->first();

        if($skill && $city) {
            $doctor = new Doctor();
            $doctor->status = 1;
            $doctor->city_id = $city->id;
            $doctor->firstname = $fio[0];
            $doctor->lastname  =  $fio[1];
            $doctor->patronymic  = $fio[2];
            $doctor->phone = $fields['phone'];
            $doctor->avatar = ltrim($fields['avatar'], '/');
            $doctor->child = ($fields['child'] == 'Да') ? 1 : 0;
            $doctor->ambulatory = ($fields['ambulatory'] == 'Да') ? 1 : 0;
            $doctor->qualification = $fields['qualifications'];
            $doctor->works_since_unix = $fields['works_since_unix'];
            $doctor->works_since = $fields['works_since'];
            $doctor->price = $fields['price'];
            $doctor->save();

            // Update alias.
            $transName = \Slug::make($doctor->name);
            $doctor->alias = $doctor->id . "-" . $transName;
            $doctor->save();

            $doctor->skills()->sync([$skill->id]);

            return env('APP_URL') . '/' . $city->alias . '/doctor/' . $doctor->alias;
        }
    }
}