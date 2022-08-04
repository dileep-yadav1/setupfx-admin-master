<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        "admin_id", "full_name", "sales_agent", "email", "company_name", "company_email", "phone", "tags"
    ];
}
