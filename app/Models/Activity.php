<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        "type",
        "activity_type",
        "admin_id",
        "user_id",
        "activity_msg",
        "status",
        "created_by",
        "updated_by",
        "created_at",
        "updated_at",
    ];
}
