<?php

namespace Rizk\Blog\Classes;

interface DB{
    public function insert($document);
    public function selectOne($filter,$options=[]);
    public function selectMany($filter,$options=[]);
    public function update($filter,$update,$options=[]);
    public function delete($filter,$options=[]);
}