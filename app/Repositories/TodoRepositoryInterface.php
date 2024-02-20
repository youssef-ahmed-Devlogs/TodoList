<?php

namespace App\Repositories;

use Closure;

interface TodoRepositoryInterface
{
    public function all();

    public function paginate(int $count, Closure $where = null);

    public function count(Closure $where = null);

    public function find(int $id);

    public function create(array $data);

    public function update(int $id, array $data);

    public function delete(int $id);
}
