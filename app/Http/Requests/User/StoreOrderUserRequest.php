<?php

namespace App\Http\Requests\User;

use App\Helpers\FormatHelper;
use App\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrderUserRequest extends FormRequest
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
        $rules = [
            'name' => 'required|max:255',
        ];

        if (!$this->input('force_phone', false)) {
            $rules['phone'] = Rule::unique('users')->where(function (Builder $query) {
                return $query->where('role', 3);
            });
            $id = $this->input('id', false);
            if ($id) {
                $user = User::find($id);
                $rules['phone'] = $rules['phone']->where(function (Builder $query) use ($user) {
                    return $query->where('id', '!=', $user->id)->where('phone', '!=', $user->phone);
                });
            }
        }

        return $rules;
    }

    public function messages()
    {
        $messsages = array(
            'name.*' => 'Введите имя',
            'phone.*' => 'Уникальный телефон',
        );
        return $messsages;
    }

    protected function prepareForValidation()
    {
        $phone = $this->request->get('phone', false);
        if ($phone)
            $this->request->set('phone', FormatHelper::phone($phone));
        else
            parent::prepareForValidation();
    }
}
