<?php

namespace App\Http\Requests;

class StoreCountry extends Request {
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
      'iso' => 'required|size:2',
      'name' => 'required|max:255'
    ];
  }
}
