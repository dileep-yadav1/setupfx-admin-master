<?php

namespace App\Models;

use App\Models\AdminDetail;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function UserData()
    {
        return $this->hasMany(User::class, 'admin_id')->count();
        // return $data = $this->hasMany(User::class, 'admin_id')->pluck('id');
    }

    public function metaData()
    {
        return $this->hasMany(AdminDetail::class, 'admin_id')->pluck('meta_value', 'meta_key');
    }

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'zipcode',
        'fax',
        'reg_no',
        'reg_date',
        'vat_no',
        'gst_no',
        'pan_no',
        'stage_status',
        'status',
        'created_by',
        'updated_by',
        'ip_address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
