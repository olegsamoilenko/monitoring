<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarRequest extends FormRequest
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
          'post' => ['nullable', 'numeric'],
          'direction' => ['nullable', 'string'],
          'address' => ['nullable', 'string'],
          'number' => ['required', 'string', 'regex:/^[а-яА-Яа-щА-ЩЬьЮюЯяЇїІіЄєҐґ0-9]+$/'],
          'type' => ['required', 'string'],
          'brand' => ['required', 'string'],
          'model' => ['max:255'],
          'color' => ['required', 'string'],
          'comment' => ['max:1000'],
          'user_id' => ['required', 'numeric'],
          'created' => ['required'],
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
      'post.numeric' => 'Виберіть номер посту.',
      'direction.string' => 'Виберіть напрямок.',
      'address.string' => 'Введіть адресу.',
      'number.required' => 'Введіть номер автомобіля українськими літерами без пробілів та інших знаків. Регистр значення не має. Наприклад ВІ2345ВА, 12345ві, по1122по.',
      'number.string' => 'Введіть корректно номер автомобіля українськими літерами без пробілів та інших знаків. Регистр значення не має. Наприклад ВІ2345ВА, 12345ві, по1122по.',
      'number.regex' => 'Введіть номер автомобіля українськими літерами без пробілів та інших знаків. Регистр значення не має. Наприклад ВІ2345ВА, 12345ві, по1122по',
      'type.required' => 'Виберіть тип автомобіля.',
      'type.string' => 'Виберіть тип автомобіля.',
      'brand.required' => 'Виберіть марку автомобіля.',
      'brand.string' => 'Виберіть марку автомобіля.',
      'model.max' => 'Максимальна кількість символів 255.',
      'color.required' => 'Виберіть колір автомобіля.',
      'color.string' => 'Виберіть колір автомобіля.',
      'comment.max' => 'Максимальна кількість символів 1000.',
      'user_id.required' => 'Зарееструйтеля або ввійдіть в систему.',
      'user_id.numeric' => 'Зарееструйтеля або ввійдіть в систему.',
    ];
  }
}
