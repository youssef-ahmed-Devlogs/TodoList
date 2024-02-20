<?php

namespace App\Services;

use App\Factories\NormalTodoFactory;
use App\Factories\PersonalTodoFactory;
use App\Factories\WorkTodoFactory;
use App\Models\Todo;
use App\Repositories\TodoRepositoryInterface;

class TodoService
{
    public function __construct(private TodoRepositoryInterface $todoRepository)
    {
    }

    public function get($filter = [])
    {
        return $this->todoRepository->paginate(8, function ($query) use ($filter) {
            if ($filter['status'] == 'completed') {
                $query->where('completed', 1);
            }

            if ($filter['status'] == 'in_progress') {
                $query->where('completed', 0);
            }

            if ($filter['category'] != 'all') {
                $query->where('category', $filter['category']);
            }
        });
    }

    public function find($id)
    {
        return $this->todoRepository->find($id);
    }

    public function create($data)
    {
        if ($data['todo_category'] == 'personal') {
            $factory = new PersonalTodoFactory($this->todoRepository);
        } elseif ($data['todo_category'] == 'work') {
            $factory = new WorkTodoFactory($this->todoRepository);
        } else {
            $factory = new NormalTodoFactory($this->todoRepository);
        }

        return $factory->createTodo(['todo_text' => $data['todo_text']]);
    }

    public function update($id, array $data)
    {
        $this->todoRepository->update($id, [
            'todo_text' => $data['todo_text'],
            'category' => $data['todo_category'],
        ]);
    }

    public function delete($id)
    {
        $this->todoRepository->delete($id);
    }

    public function changeCompletedStatus($id)
    {
        $todo = $this->todoRepository->find($id);
        $todo->completed = !$todo->completed;
        $todo->save();
        return $todo;
    }
}
