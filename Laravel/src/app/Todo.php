<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    //
    protected $fillable = [
        "title",
        "content",
        "priority",
        "created_at",
        "updated_at",
    ];
    protected $table = "todos";
}
