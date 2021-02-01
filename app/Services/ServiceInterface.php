<?php

namespace App\Services;

interface ServiceInterface
{
    public function store(array $data) : bool;
}
