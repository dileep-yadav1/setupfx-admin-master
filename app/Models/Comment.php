<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        "type",
        "client_id",
        "admin_id",
        "files",
        "status",
        "created_by",
        "updated_by",
        "created_at",
        "updated_at",
    ];
}
