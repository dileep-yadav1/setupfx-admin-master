<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminEmailSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        "admin_id",
        "driver",
        "host",
        "port",
        "encryption",
        "username",
        "password",
        "sender_email",
        "sender_name",
        "created_by",
        "updated_by",
        "created_at",
        "updated_at",
    ];
}
