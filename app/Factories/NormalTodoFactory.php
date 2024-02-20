<?php

namespace App\Factories;

use App\Models\Todo;
use App\Repositories\TodoRepositoryInterface;

class NormalTodoFactory implements TodoFactory
{
    public function __construct(private TodoRepositoryInterface $todoRepository)
    {
    }

    public function createTodo(array $data): Todo
    {
        return $this->todoRepository->create($data);
    }
}
