<?php

namespace App\Presenters;

use Exception;

abstract class Presenter
{

    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function __get($property)
    {
        if (method_exists($this, $property)) {
            return call_user_func([$this, $property]);
        }

        $message = '%s does not respond to the "%s" property or method.';

        throw new Exception(
            sprintf($message, static::class, $property)
        );
    }
}
