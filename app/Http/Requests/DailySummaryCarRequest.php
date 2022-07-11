<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DailySummaryCarRequest extends FormRequest
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
          'number' => ['required', 'string', 'regex:/^[а-яА-Яа-щА-ЩЬьЮюЯяЇїІіЄєҐґ0-9]+$/', 'unique:daily_summary_cars'],
          'type' => ['required', 'string'],
          'brand' => ['required', 'string'],
          'model' => ['max:255'],
          'color' => ['required', 'string'],
          'comment' => ['required','max:1000'],
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
      'number.required' => 'Введіть номер автомобіля.',
      'number.string' => 'Введіть корректно номер автомобіля.',
      'number.regex' => 'Введіть номер автомобіля українськими літерами без пробілів та інших знаків. Регистр значення не має. Наприклад ВІ2345ВА, 12345ві, по1122по',
      'number.unique' => 'Такий автомобіль вже додано',
      'type.required' => 'Виберіть тип автомобіля.',
      'type.string' => 'Виберіть тип автомобіля.',
      'brand.required' => 'Виберіть марку автомобіля.',
      'brand.string' => 'Виберіть марку автомобіля.',
      'model.max' => 'Максимальна кількість символів 255.',
      'color.required' => 'Виберіть колір автомобіля.',
      'color.string' => 'Виберіть колір автомобіля.',
      'comment.required' => 'Додайте комментар',
      'comment.max' => 'Максимальна кількість символів 1000.',
    ];
  }
}
