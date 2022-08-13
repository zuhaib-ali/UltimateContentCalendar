<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "platform",
        "comment_type",
        "url",
        "actual_comment",
        "feedback",
        "status",
        "user_id"
    ];
}
