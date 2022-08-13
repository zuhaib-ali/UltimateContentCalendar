<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $casts = [
        "permissions_id" => "array"
    ];

    protected $fillable = [
        "role",
        "description",
        "permissions_id"
    ];
}
