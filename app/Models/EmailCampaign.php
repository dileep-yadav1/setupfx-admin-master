<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailCampaign extends Model
{
    use HasFactory;

    protected $fillable = [
        "type",
        "campaign_name",
        "from_name",
        "from_email",
        "reply_to",
        "subject",
        "message",
        "test_emails",
        "sent_date",
        "status",
        "created_by",
        "updated_by",
        "created_at",
        "updated_at"
    ];
}
