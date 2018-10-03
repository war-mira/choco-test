<?php

namespace App\Http\Requests\Admin\SmsNotification;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreSmsNotificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $role = auth()->user()->role;
        return $role == 1;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    protected function prepareForValidation()
    {
        $sendAt = $this->request->get('send_at', false);
        if ($sendAt)
            $this->request->set('send_at', Carbon::createFromFormat("Y-m-d\TH:i", $sendAt));
        else
            parent::prepareForValidation();
    }
}
