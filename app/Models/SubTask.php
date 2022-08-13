<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTask extends Model
{
    use HasFactory;

    protected $fillable = [
        "subject",
        "description",
        "main_task",
        "status",
        "pending_date",
        "in_progress_date",
        "approve_date",
        "complete_data",
        "revined",
    ];
}
