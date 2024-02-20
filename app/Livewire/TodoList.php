<?php

namespace App\Livewire;

use App\Repositories\TodoRepositoryInterface;
use App\Services\TodoService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class TodoList extends Component
{
    use WithPagination, WithoutUrlPagination;

    private TodoRepositoryInterface $todoRepository;
    private TodoService $todoService;

    public string $todo_text;
    public string $todo_category = 'normal';

    public string $todo_text_update;
    public string $todo_category_update;
    public $updateMode = null;

    public $filter = [
        'status' => 'all',
        'category' => 'all'
    ];

    public function boot(TodoRepositoryInterface $todoRepository, TodoService $todoService)
    {
        $this->todoRepository = $todoRepository;
        $this->todoService = $todoService;
    }

    public function updateTodoMode($id)
    {
        $this->updateMode = $id;
        $todo = $this->todoService->find($id);
        $this->todo_text_update = $todo->todo_text;
        $this->todo_category_update = $todo->category;
    }

    public function setFilter(string $key, string $val)
    {
        $this->filter[$key] = $val;
        $this->resetPage();
    }

    public function resetFilter()
    {
        $this->filter = [
            'status' => 'all',
            'category' => 'all'
        ];
        $this->resetPage();
    }

    public function changeCompletedStatus($id)
    {
        $this->todoService->changeCompletedStatus($id);
    }

    public function createTodo()
    {
        $this->todoService->create([
            'todo_text' => $this->todo_text,
            'todo_category' => $this->todo_category,
        ]);
        $this->reset('todo_text', 'todo_category');
    }

    public function updateTodo($id)
    {
        $this->todoService->update($id, [
            'todo_text' => $this->todo_text_update,
            'todo_category' => $this->todo_category_update,
        ]);
        $this->reset(['todo_text_update', 'updateMode']);
    }

    public function deleteTodo($id)
    {
        $this->todoService->delete($id);
    }

    public function render()
    {
        $todos = $this->todoService->get($this->filter);

        return view('livewire.todo-list', [
            'todos' => $todos,
            'todosCount' => $this->todoRepository->count(),
            'completedTodosCount' => $this->todoRepository->count(fn ($q) => $q->where('completed', 1)),
            'inProgressTodosCount' => $this->todoRepository->count(fn ($q) => $q->where('completed', 0)),
        ]);
    }
}
