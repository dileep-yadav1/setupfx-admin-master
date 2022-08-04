<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        "admin_id","meta_key","meta_value","created_at","updated_at"
    ];
}
