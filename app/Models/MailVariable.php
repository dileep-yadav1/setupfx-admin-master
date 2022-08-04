<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailVariable extends Model
{
    use HasFactory;

    protected $fillable = [
        "variable_key","variable_value","created_at","updated_at"
    ];
}
