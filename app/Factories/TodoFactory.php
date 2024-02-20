<?php

namespace App\Factories;

use App\Models\Todo;

interface TodoFactory
{
    public function createTodo(array $data): Todo;
}
