<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        "admin_id","setting_group","meta_key","meta_value","created_by","updated_by","created_at","updated_at"
    ];
}
