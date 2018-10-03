<?php

namespace App\Http\Controllers\Telegram;

use App\Callback;
use App\Http\Controllers\Controller;
use App\Model\Telegram\BotUser;
use App\Skill;
use Illuminate\Support\Facades\Config;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\Update;

class TelegramBotController extends Controller
{


    public function processUpdates($bottoken)
    {
        $originalToken = Config::get('telegram.bot_token');
        if ($originalToken && $bottoken == $originalToken) {
            $update = \Telegram::getWebhookUpdates();
            $this->processUpdate($update);
        }
    }

    /**
     * @param Update $update
     */
    private function processUpdate($update)
    {
        $chatId = $update->getMessage()->getChat()->getId();
        /** @var BotUser $botUser */
        $botUser = BotUser::query()->firstOrCreate(['chat_id' => $chatId]);
        if ($update->getMessage()->getText() == '/start') {
            $this->sendCityMenu($botUser);
        } else if ($botUser->menu_id == -1) {
            $this->handleCityMenu($botUser, $update->getMessage());
        } else if ($botUser->menu_id == 0) {
            $this->handleMainMenu($botUser, $update->getMessage());
        } else if ($botUser->menu_id == 1) {
            $this->handleSearchMenu($botUser, $update->getMessage());
        } else if ($botUser->menu_id == 2) {
            $this->handleReceptionMenu($botUser, $update->getMessage());
        } else if ($botUser->menu_id == 3) {
            $this->handleAboutMenu($botUser, $update->getMessage());
        } else if ($botUser->menu_id == 4) {
            $this->handleSkillMenu($botUser, $update->getMessage());
        }
    }

    private function sendMainMenu(BotUser $botUser)
    {
        $botUser->menu_id = 0;
        $botUser->save();
        $keyboard = [
            ['Поиск врача'],
            ['Быстрая запись'],
            ['О сервисе']
        ];
        $murkup = \Telegram::replyKeyboardMarkup([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => false
        ]);
        /** @var Update $update */
        $message = \Telegram::sendMessage([
            'chat_id' => $botUser->chat_id,
            'text' => 'Главное меню',
            'reply_markup' => $murkup
        ]);
    }

    private function sendCityMenu(BotUser $botUser)
    {
        $botUser->menu_id = -1;
        $botUser->save();
        $keyboard = [
            ['Алматы'],
            ['Астана']
        ];
        $murkup = \Telegram::replyKeyboardMarkup([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => false
        ]);
        /** @var Update $update */
        $message = \Telegram::sendMessage([
            'chat_id' => $botUser->chat_id,
            'text' => 'Выберите ваш город',
            'reply_markup' => $murkup
        ]);
    }

    private function sendSkillMenu(BotUser $botUser, $skill)
    {
        $botUser->menu_id = 4;
        $botUser->save();
        $keyboard = [];
        $text = "Врачи - " . $skill->name . "\r\n" . "➖➖➖➖➖➖➖➖➖➖\r\n";
        $doctors = $skill->publicDoctors()->where('city_id', $botUser->city_id)->orderBy('lastname')->get();
        foreach ($doctors as $doctor) {
            $text .= $doctor->name . "\r\n(Рейтинг " . $doctor->rate . "/Отзывов " . $doctor->publicComments()->count() . ")\r\n";
            $text .= route('doctors.profile', ['alias' => $doctor->id]) . "\r\n";
        }

        $keyboard[] = ['В главное меню'];
        $murkup = \Telegram::replyKeyboardMarkup([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => false
        ]);
        /** @var Update $update */
        $message = \Telegram::sendMessage([
            'chat_id' => $botUser->chat_id,
            'text' => $text,
            'reply_markup' => $murkup,
            'disable_web_page_preview' => true
        ]);
    }

    private function sendSearchMenu(BotUser $botUser)
    {
        $botUser->menu_id = 1;
        $botUser->save();
        $keyboard = [];
        $text = "Специализации\r\n" . "➖➖➖➖➖➖➖➖➖➖\r\n";
        $skills = Skill::query()->orderBy('name')->get();
        foreach ($skills as $skill) {
            $count = $skill->publicDoctors()->where('city_id', $botUser->city_id)->count();
            if ($count <= 0)
                continue;
            $text .= $skill->name . "(" . $count . ")\r\n";
            $keyboard[] = [$skill->name];
        }

        $keyboard[] = ['В главное меню'];
        $murkup = \Telegram::replyKeyboardMarkup([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => false
        ]);
        /** @var Update $update */
        $message = \Telegram::sendMessage([
            'chat_id' => $botUser->chat_id,
            'text' => $text,
            'reply_markup' => $murkup
        ]);
    }

    private function sendReceptionMenu(BotUser $botUser)
    {
        $botUser->menu_id = 2;
        $botUser->save();
        $keyboard = [
            [['text' => 'Оставить заявку', 'request_contact' => true]],
            [['text' => 'В главное меню']]
        ];
        $murkup = \Telegram::replyKeyboardMarkup([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => false
        ]);
        /** @var Update $update */
        $message = \Telegram::sendMessage([
            'chat_id' => $botUser->chat_id,
            'text' => 'Поделитесь вашими контактными данными, чтобы оставить заявку.',
            'reply_markup' => $murkup
        ]);
    }

    private function sendAboutMenu(BotUser $botUser)
    {
        $botUser->menu_id = 3;
        $botUser->save();
        $keyboard = [
            ['В главное меню'],
        ];
        $murkup = \Telegram::replyKeyboardMarkup([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => false
        ]);
        /** @var Update $update */
        $message = \Telegram::sendMessage([
            'chat_id' => $botUser->chat_id,
            'text' => 'http://idoctor.kz',
            'reply_markup' => $murkup
        ]);
    }

    private function handleSearchMenu(BotUser $botUser, Message $message)
    {
        $text = $message->getText();
        if ($text == 'В главное меню')
            $this->sendMainMenu($botUser);
        else {
            $skill = Skill::whereName($text)->get()->first();
            $this->sendSkillMenu($botUser, $skill);
        }
    }

    private function handleReceptionMenu(BotUser $botUser, Message $message)
    {
        if ($contact = $message->getContact()) {
            $phone = $contact->getPhoneNumber();
            $name = $contact->getFirstName();
            $callback = Callback::query()->create([
                'client' => $name,
                'date_event' => date("Y-m-d H:i:s"),
                'phone' => $phone,
                'skill_id' => Skill::query()->first()->id,
                'doc_id' => null,
            ]);
            $message = \Telegram::sendMessage([
                'chat_id' => $botUser->chat_id,
                'text' => 'Ваша заявка принята в ближайшее время с вами свяжется наш оператор!',
                'reply_markup' => \Telegram::replyKeyboardMarkup([
                    'keyboard' => [],
                    'resize_keyboard' => true,
                    'one_time_keyboard' => false
                ])
            ]);
            $this->sendMainMenu($botUser);
        } else if ($message->getText() == 'В главное меню')
            $this->sendMainMenu($botUser);
    }

    private function handleAboutMenu(BotUser $botUser, Message $message)
    {
        if ($message->getText() == 'В главное меню')
            $this->sendMainMenu($botUser);
    }

    private function handleSkillMenu(BotUser $botUser, Message $message)
    {
        if ($message->getText() == 'В главное меню')
            $this->sendMainMenu($botUser);
    }

    private function handleMainMenu(BotUser $botUser, Message $message)
    {
        if ($message->getText() == 'Поиск врача')
            $this->sendSearchMenu($botUser);
        else if ($message->getText() == 'Быстрая запись')
            $this->sendReceptionMenu($botUser);
        else if ($message->getText() == 'О сервисе')
            $this->sendAboutMenu($botUser);
    }

    private function handleCityMenu(BotUser $botUser, Message $message)
    {
        if ($message->getText() == 'Алматы') {
            $botUser->city_id = 6;
            $botUser->save();
            $this->sendMainMenu($botUser);
        } else if ($message->getText() == 'Астана') {
            $botUser->city_id = 7;
            $botUser->save();
            $this->sendMainMenu($botUser);
        } else
            $this->sendCityMenu($botUser);
    }
}
