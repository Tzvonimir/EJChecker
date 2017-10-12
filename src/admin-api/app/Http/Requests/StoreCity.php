<?php

namespace App\Http\Requests;

class StoreCity extends Request {
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
    if($this->method() == 'Store'){
      return [
        'name' => 'required|max:255',
        'country_id' => 'required'
      ];
    }
    return [
      'name' => 'required|max:255'
    ];
  }
}
