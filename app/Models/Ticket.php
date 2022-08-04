<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    const ADMIN      = 0;
    const SUPERADMIN = 1;

    public static $getTicketType = [
        self::ADMIN => "Admin",
        self::SUPERADMIN => "Super Admin"
    ];

    protected $fillable = [
        "type","department","subject","reporter","priority",
        "tags","file","created_by","updated_by","admin_id",
        "status","created_at","updated_at","deleted_at"
    ];
}
