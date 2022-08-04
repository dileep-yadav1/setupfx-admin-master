<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadEmail extends Model
{
    use HasFactory;

    protected $fillable = [
        "lead_id",
        "emailtype",
        "subject",
        "message",
        "mail_file",
        "sent_date",
        "status",
        "created_by",
        "updated_by",
        "created_at",
        "updated_at",
    ];
}
