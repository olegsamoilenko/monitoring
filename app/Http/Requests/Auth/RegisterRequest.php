<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegisterRequest extends FormRequest
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
          'name' => ['required', 'string', 'max:255'],
          'surname' => ['required', 'string', 'max:255'],
          'phone' => ['required', 'regex:/^\+?\d{10}$/', 'unique:users'],
          'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
          'password' => ['required', 'confirmed', 'min:7'],
        ];
    }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array
   */

  public function messages(): array
  {
    return [
      'name.required' => 'Поле Ім\'я є обов\'язкове.',
      'name.string' => 'Поле Ім\'я має бути рядком.',
      'name.max' => 'Поле Ім\'я не повинно бути більше ніж 255 символів.',
      'surname.required' => 'Поле Прізвище є обов\'язкове.',
      'surname.string' => 'Поле Прізвище має бути рядком.',
      'surname.max' => 'Поле Прізвище не повинно бути більше ніж 255 символів.',
      'phone.required' => 'Поле Телефон є обов\'язкове.',
      'phone.regex' => 'Введіть телефон в форматі 0501234567.',
      'phone.unique' => 'Такий Телефон вже існує в базі. Введіть інший.',
      'email.required' => 'Поле Email є обов\'язкове.',
      'email.email' => 'Поле Email має бути дійсною адресою електронної пошти.',
      'email.string' => 'Поле Email має бути рядком.',
      'email.max' => 'Поле Email не повинно бути більше ніж 255 символів.',
      'email.unique' => 'Така email адреса вже існує в базі. Увійдіть до свого облікового запису.',
      'password.required' => 'Поле Пароль є обов\'язкове.',
      'password.confirmed' => 'Підтвердження пароля не збігається.',
      'password.min' => 'Пароль має містити мінімум 7 символів.',
    ];
  }
}
