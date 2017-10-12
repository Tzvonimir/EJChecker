<?php

namespace App\Http\Requests;


class StoreAppConfiguration extends Request {
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
      'key' => 'required|max:255',
      'value' => 'required|max:255'
    ];
  }

}