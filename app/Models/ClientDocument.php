<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        "admin_id",
        "client_id",
        "admin_id",
        "doc_type",
        "description",
        "front_side",
        "back_side",
        "status",
        "created_by",
        "updated_by",
    ];
}
