<?php

namespace Rizk\Blog\Classes\Validation;

interface Validator{
    public function check($key,$value);
}