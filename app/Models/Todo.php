<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    //
    protected $table = 'lists_todo';

    protected $fillable = [
        'title',
        'description',
        'assigned_id',
        'author_id',
        'status',
        'created_at',
        'updated_at',
    ];

    public function assignedUser() {
        return $this->belongsTo(User::class, 'assigned_id');
    }
    public function authorUser() {
        return $this->belongsTo(User::class, 'author_id');
    }
}
