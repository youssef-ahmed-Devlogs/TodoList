<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = ['todo_text', 'completed', 'user_id', 'category'];

    protected static function booted()
    {
        static::addGlobalScope('getMyTodos', function (Builder $builder) {
            $builder->where('user_id', auth()->id());
        });
    }
}
