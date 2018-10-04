<?php

namespace App\Http\Requests\Doctor;

use App\Enums\OrderStatus;
use App\Rules\PhoneNumber;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateNewComment extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'author_phone' => ['required_without:author_id', new PhoneNumber, Rule::exists('patients', 'phone')->where(function (Builder $query) {
                $query->join('orders', 'orders.patient_id', '=', 'patients.id')
                    ->having('orders.doc_id', '=', $this->input('doctor_id'))
                    ->having('orders.status', [OrderStatus::VISIT_SUCCESS, OrderStatus::VISIT_CHECK]);

            })],
            'author_name'  => 'required_without:author_id|min:2|max:50',
            'author_rate'  => 'required|integer|min:1|max:10',
            'text'         => 'required|min:30|max:1000',

        ];
    }

    public function messages()
    {
        return [
            'author_name.min'      => 'Имя должно быть длиннее :min символов',
            'text.min'             => 'Отзыв должен быть длиннее :min символов',
            'author_name.max'      => 'Имя должно быть длиннее :max символов',
            'text.max'             => 'Отзыв должен быть длиннее :max символов',
            'author_phone.*'       => 'Укажите телефон, который был использован для записи на прием через iDoctor.kz',
            'author_rate.*'        => 'Оцените работу врача',
            'author_name.required' => 'Введите имя',
            'text.required'        => 'Напишите отзыв',
        ];
    }


}
