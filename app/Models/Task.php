<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TodoList;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    public const STARTED='started';
    public const COMPLETED='completed';
    public const PENDING='pending';
    public const CANCELLED='cancelled';
    public const FAILED='failed';
    public const NOT_STARTED='not_started';

    protected $fillable=['title','todo_list_id','status'];

    public function todoList():BelongsTo{
        return $this->belongsTo(TodoList::class);
    }

}
