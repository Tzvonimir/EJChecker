<?php

namespace App\Http\Requests;

class StoreMedia extends Request {
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
        'uploaded_by_id' => 'required',
        'filename' => 'required|max:255',
        'filesize' => 'required',
        'documentable_id' => 'required',
        'documentable_type' => 'required',
        'original_filename' => 'required|max:255'
      ];
    }
    return [
      'name' => 'required|max:255',
      'filename' => 'required|max:255',
      'filesize' => 'required',
      'original_filename' => 'required|max:255'
    ];
  }
}
