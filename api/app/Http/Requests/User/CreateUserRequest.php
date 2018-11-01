<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:100',
            'email' => 'required',
            'password' => 'required',
            'user_role' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'O campo name é obrigatório.',
            'name.max' => 'O campo name só pode ter um máximo de 100 carateres',
            'email.required' => 'O campo email é obrigatório.',
            'password.required' => 'O campo password é obrigatório',
            'user_role.required' => 'O campo user_role é obrigatório.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        //throw new ErrorException($validator->errors()->first());
        throw new HttpResponseException(response()->json(
            [
                'status' => 422,
                'data' => $validator->errors(),
                'msg' => "Erro de validação."
            ], 422
        ));
    }
}
