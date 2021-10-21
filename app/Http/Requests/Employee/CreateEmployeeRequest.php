<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmployeeRequest extends FormRequest
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
    // |regex:/(01)[0-9]{9}/
    return [
      'first_name' => 'required|min:3|max:100',
      'last_name' => 'required|min:3|max:100',
      'email' => 'required|unique:employees,email',
      'phone_number' => 'required',
      'company_id' => 'required|exists:companies,id',
    ];
  }
}
