<?php

namespace App\Http\Controllers;

use App\Repositories\Currency\CurrencyRepository;
use App\Http\Requests\StoreCurrency;

class CurrencyController extends AppController {
  /**
   * @var CurrencyRepository
   */
  private $currencies;

  function __construct(CurrencyRepository $currencies) {
    $this->currencies = $currencies;
  }

  /**
   * Display a listing of the resource.
   *
   * @return array
   */
  public function index() {
    $this->allowIf(['currencies/module', 'currencies/index']);
    return ['success' => true, 'currencies' => $this->currencies->getPaginated()];
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  CurrencyRepository  $request
   * @return array
   */
  public function store(StoreCurrency $request) {
    $this->allowIf(['currencies/module', 'currencies/store']);
    $currency = $this->currencies->create($request->input());
    return ['success' => !!$currency];
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return array
   */
  public function show($id) {
    $this->allowIf(['currencies/module', 'currencies/show']);
    $currency = $this->currencies->getById($id);
    return ['success' => true, 'currencies' => $currency];
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  StoreCurrency  $request
   * @param  int  $id
   * @return array
   */
  public function update(StoreCurrency $request, $id) {
    $this->allowIf(['currencies/module', 'currencies/update']);
    $result = $this->currencies->update($request->input(), $id);
    return ['success' => !!$result];
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return array
   */
  public function destroy($id) {
    $this->allowIf(['currencies/module', 'currencies/destroy']);
    $result = $this->currencies->delete($id);
    return ['success' => !!$result];
  }
}
