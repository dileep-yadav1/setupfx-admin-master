<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    use HasFactory;
    protected $fillable = [
        "comment_id",
        "message",
        "reply_by",
        "type",
        "created_at",
        "updated_at",
    ];
}
