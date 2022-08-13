<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $guarded = [];
    // protected $fillable = [
    //     "name",
    //     "description",
    //     "project_id",
    //     "user_id",
    //     "pending_date",
    //     "process_date",
    //     "approve_date",
    //     "complete_date",
    //     "reject_date",
    //     "deadline",
    // ];
}
