<?php

namespace App\Http\Requests\Doctor;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorRequest extends FormRequest
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
            'firstname'        => 'required|max:255',
            'lastname'         => 'required|max:255',
            'works_since_year' => 'required|numeric|min:1930|max:2020',
            'qualification'    => 'nullable|max:100',
            'avatar'           => 'sometimes|nullable|image|max:1024',
            'city_id'          => 'required|exists:cities,id',
            'skills'           => 'required|array|min:1',
            'skills.*.id'      => 'required|distinct|exists:skills,id',
            'jobs'             => 'required|array|min:1',
            'jobs.*'           => 'required|distinct|exists:medcenters,id'
        ];
    }

    public function messages()
    {
        $messsages = array(
            'firstname.*' => 'Введите имя',
            'lastname.*' => 'Введите фамилию',
            'works_since_year.*' => 'Стаж работы должен быть между 1930 и 2020',
            'avatar.image' => 'Аватар должен быть изображением.',
            'avatar.max' => 'Ограничение на размер аватара 1MB.',
            'city_id.*' => 'Выберите город',
            'skills.required' => 'Добавьте хотя бы 1 специализацию!',
            'skills.* ' => 'Неверно задано поле Специализации',
            'jobs.required' => 'Добавьте хотя бы 1 медцентр!',
            'jobs.* ' => 'Неверно задано поле Медцентры'
        );
        return $messsages;
    }
}
