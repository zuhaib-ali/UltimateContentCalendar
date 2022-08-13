<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskFile extends Model
{
    use HasFactory;
    protected $guarded = [];
    // protected $fillable = [
    //     "file_name",
    //     "task_id",
    //     "sub_task_id",
    // ];
}
