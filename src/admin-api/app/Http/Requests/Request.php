<?php

namespace App\Http\Requests;

use Illuminate\Auth\Access\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest {

  public function authorize() {
    return true;
  }

  public function rules() {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  protected function formatErrors(Validator $validator) {
    $errors = [];
    $keys = $validator->errors()->keys();
    foreach ($keys as $key) {
      $messages = $validator->errors()->get($key);
      $errors[$key] = $messages;
    }
    return ['success' => false, 'errors' => $errors];
  }

 // protected static function checkUnique($data, $uniqueFields) {
  //  foreach ($uniqueFields as $uniqueField) {
    //  if (count(array_keys($array, $item)) > 1) 
      //{
        //   /* Execute code */
     // }
   // }
 // }

}