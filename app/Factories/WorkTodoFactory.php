<?php

namespace App\Factories;

use App\Models\Todo;
use App\Repositories\TodoRepositoryInterface;

class WorkTodoFactory implements TodoFactory
{
    public function __construct(private TodoRepositoryInterface $todoRepository)
    {
    }

    public function createTodo(array $data): Todo
    {
        return $this->todoRepository->create([
            ...$data,
            'category' => 'work'
        ]);
    }
}
