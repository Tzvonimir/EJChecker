<?php

namespace App\Models;

use Carbon\Carbon;
use App\Util\DateHelper;

class Combination extends AppModel
{
    public $search = [
      'first_number',
      'second_number',
      'third_number',
      'fourth_number',
      'fifth_number',
      'first_extra_number',
      'second_extra_number',
      'is_winning'
    ];

    protected $fillable = [
      'first_number',
      'second_number',
      'third_number',
      'fourth_number',
      'fifth_number',
      'first_extra_number',
      'second_extra_number'
    ];

    protected $with = [
        'firstNumber',
        'secondNumber',
        'thirdNumber',
        'fourthNumber',
        'fifthNumber',
        'firstExtraNumber',
        'secondExtraNumber'
    ];

    protected $appends = [
      'cycle',
      'date_format'
    ];

    public function firstNumber()
    {
        return $this->belongsTo(Number::class, 'first_number');
    }

    public function secondNumber()
    {
        return $this->belongsTo(Number::class, 'second_number');
    }

    public function thirdNumber()
    {
        return $this->belongsTo(Number::class, 'third_number');
    }

    public function fourthNumber()
    {
        return $this->belongsTo(Number::class, 'fourth_number');
    }

    public function fifthNumber()
    {
        return $this->belongsTo(Number::class, 'fifth_number');
    }

    public function firstExtraNumber()
    {
        return $this->belongsTo(ExtraNumber::class, 'first_extra_number');
    }

    public function secondExtraNumber()
    {
        return $this->belongsTo(ExtraNumber::class, 'second_extra_number');
    }

    public function getCycleAttribute() {
      if($this->attributes['is_winning']) {
        foreach (DateHelper::getFridays() as $cycle => $date) {
          if($date == date('Y-m-d', strtotime($this->attributes['created_at']))) {
            return $cycle + 1;
          }
        }
      }
    }

    public function getDateFormatAttribute() {
      return Carbon::parse($this->attributes['created_at'])->format('d.m.Y');
    }

}

