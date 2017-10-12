<?php

namespace App\Presenters;

class ContactPresenter extends Presenter
{

    public function fullName()
    {
        $elements = [
            $this->model->last_name,
            $this->model->first_name
        ];

        return join(' ', $elements);
    }

    public function fullPhone()
    {
        $elements = [];
        $phone = strip_tags($this->model->phone);
        $mobile = strip_tags($this->model->mobile);
        if ($phone) {
            $elements[] = $phone;
        }
        if ($mobile) {
            $elements[] = $mobile;
        }

        $result = '';
        $count = count($elements);
        if ($count === 1) {
            return $elements[0];
        } else if ($count > 1) {
            $result = $elements[0];
            for ($i = 1; $i < $count; $i++) {
                $result .= '<br />' . $elements[$i];
            }
        }
        return $result;
    }
}

