<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChevronOrderRequest extends FormRequest
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
          'chevron_id' => ['required','numeric'],
          'amount' => ['required','numeric'],
          'surname' => ['required'],
          // 'regex:/^[а-яА-Яа-щА-ЩЬьЮюЯяЇїІіЄєҐґ]+$/'
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
      'chevron_id.required' => 'Виберіть шеврон.',
      'chevron_id.numeric' => 'Виберіть шеврон по списку.',
      'amount.required' => 'Виберіть кількість.',
      'amount.numeric' => 'Виберіть кількість по списку.',
      'surname.required' => 'Введіть прізвище.',
//      'surname.regex' => 'Введіть прізвище українськими літерами.',


    ];
  }
}
