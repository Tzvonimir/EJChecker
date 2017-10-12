<?php

namespace App\Http\Requests;

class StoreCombination extends Request {
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize() {
    return parent::authorize();
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules() {
    return [
      'first_number' => 'required',
      'second_number' => 'required',
      'third_number' => 'required',
      'fourth_number' => 'required',
      'fifth_number' => 'required',
      'first_extra_number' => 'required',
      'second_extra_number' => 'required'
    ];
  }
}
