<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
      'number' => ['required', 'numeric'],
      'direction_1' => ['required'],
      'direction_2' => ['required'],
      'direction_3' => ['nullable'],
      'direction_4' => ['nullable'],
      'direction_5' => ['nullable'],
      // 'regex:/^[\.\,\№\-\sa-zA-Zа-яА-Яа-щА-ЩЬьЮюЯяЇїІіЄєҐґ0-9]+$/'
      // 'regex:/^[\.\,\№\-\sa-zA-Zа-яієїґА-ЯІЄЇ0-9]+$/'
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
      'number.required' => 'Введіть номер посту.',
      'number.numeric' => 'Введіть номер посту цифрою.',
      'number.unique' => 'Такий пост вже існуе в базі.',
      'direction_1.required' => 'Введіть напрямок.',
      'direction_2.required' => 'Введіть напрямок.',
//      'direction_1.regex' => 'Напрямок 1 може містити тільки літери, пробіл, тире, крапку, кому, знак №.',
//      'direction_2.regex' => 'Напрямок 2 може містити тільки літери, пробіл, тире, крапку, кому, знак №.',
//      'direction_3.regex' => 'Напрямок 3 може містити тільки літери, пробіл, тире, крапку, кому, знак №.',
//      'direction_4.regex' => 'Напрямок 4 може містити тільки літери, пробіл, тире, крапку, кому, знак №.',
//      'direction_5.regex' => 'Напрямок 5 може містити тільки літери, пробіл, тире, крапку, кому, знак №.',
    ];
  }
}
