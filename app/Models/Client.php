<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    const FCAEBOOK = 1;
    const GOOGLE = 2;
    const WEB = 3;
    const TWITTER = 4;
    const CLIENTREFERRAL = 5;
    const YOUTUBE = 6;
    const MAILCHIMP = 7;
    const PREVIOUSCLIENT = 8;
    const EMAILLIST = 9;
    const GOOGLEADS = 10;
    const OTHER = 11;

    public static $getSource = [
        self::FCAEBOOK => "Facebook",
        self::GOOGLE => "Google Organic",
        self::WEB => "Web",
        self::TWITTER => "Twitter",
        self::CLIENTREFERRAL => "Client Referral",
        self::YOUTUBE => "Youtube",
        self::MAILCHIMP => "Mailchimp",
        self::PREVIOUSCLIENT => "Previous Client",
        self::EMAILLIST => "Email List",
        self::GOOGLEADS => "Google Ads",
        self::OTHER => "Other",
    ];

    const NEWLEAD = 1;
    const KYC = 2;
    const DEPOSIT = 3;

    public static $getStage = [
        self::NEWLEAD => "New Lead",
        self::KYC => "KYC Verified",
        self::DEPOSIT => "Deposit Made",
    ];

    const ACTIVE = 1;
    const INACTIVE = 2;

    public static $getStatus = [
        self::ACTIVE => 'Active',
        self::INACTIVE => 'In Active',
    ];

    const A = 1;
    const B = 2;
    const C = 3;
    const D = 4;
    const E = 5;
    const F = 6;

    public static $getSalesAgent = [
        self::A => "A",
        self::B => "B",
        self::C => "C",
        self::D => "D",
        self::E => "E",
        self::F => "F",
    ];
    protected $fillable = [
        'admin_id',
        'first_name',
        'last_name',
        'email',
        'contact',
        'company_name',
        'country',
        'country_id',
        'state_id',
        'city_id',
        'net_worth',
        'annual_income',
        'emp_status',
        'dob',
        'address_1',
        'address_2',
        'source_income',
        'invest_known',
        'objective_exp',
        'nationality',
        'previous_exp',
        'initial_amt',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
