<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = ["type", "admin_id", "user_id", "title", "venue", "desc", "start_date", "end_date", "calendar", "project", "attendees", "event_color", "alert"];
}
