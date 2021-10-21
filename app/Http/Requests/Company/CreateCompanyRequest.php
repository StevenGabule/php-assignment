<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class CreateCompanyRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules(): array
  {
    $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
    return [
      'name' => 'required|min:3|max:100',
      'email' => 'required|unique:companies,email',
      'website' => 'required|regex:' . $regex,
      'address' => 'required|min:10',
      'logo' => 'required|mimes:jpeg,gif,bmp,png|max:2048',
    ];
  }
}
