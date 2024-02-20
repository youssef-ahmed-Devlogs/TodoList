<?php

namespace App\Repositories;

use App\Models\Todo;
use Closure;

class TodoRepository implements TodoRepositoryInterface
{
    public function all()
    {
        return Todo::all();
    }

    public function paginate(int $count, Closure $where = null)
    {
        if ($where) {
            return Todo::where($where)->latest()->paginate($count);
        }
        return Todo::latest()->paginate($count);
    }

    public function count(Closure $where = null)
    {
        if ($where) {
            return Todo::where($where)->count();
        }
        return Todo::count();
    }

    public function find(int $id)
    {
        return Todo::find($id);
    }

    public function create(array $data)
    {
        return Todo::create($data);
    }

    public function update(int $id, array $data)
    {
        return Todo::find($id)->update($data);
    }

    public function delete(int $id)
    {
        return Todo::find($id)->delete();
    }
}
