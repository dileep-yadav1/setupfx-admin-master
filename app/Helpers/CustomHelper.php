<?php
namespace App\Helpers;

use App\Mail\SendMail;
use App\Models\Activity;
use App\Models\AdminDetail;
use App\Models\AdminEmail;
use App\Models\AdminSetting;
use App\Models\TabParameter;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;

class CustomHelper
{
    const ACTIVITYUSER = 1;
    const ACTIVITYCLIENT = 2;
    const ACTIVITYLEAD = 3;
    const ACTIVITYACCOUNT = 4;
    const ACTIVITYDOCUMENT = 5;
    const ACTIVITYTRANSACTION = 6;
    const SUPERADMIN = 1;
    const ADMIN = 2;
    const ADMIN_AVATAR_URL = "http://superadmin.websitetest.co.in/public/uploads/admin_doc/";
    const STAFF_AVATAR_URL = "http://admin.websitetest.co.in/public/uploads/";
    const LOW = 1;
    const MEDIUM = 2;
    const HIGH = 3;
    const URGENT = 4;

    public static $getPriorityType = [
        self::LOW => "LOW",
        self::MEDIUM => "MEDIUM",
        self::HIGH => "HIGH",
        self::URGENT => "URGENT",
    ];

    public static $getPriorityBadge = [
        self::LOW => "info",
        self::MEDIUM => "primary",
        self::HIGH => "warning",
        self::URGENT => "danger",
    ];

    const ACTIVE = 1;
    const INACTIVE = 2;

    public static $getStatus = [
        self::ACTIVE => "Active",
        self::INACTIVE => "Inactive",
    ];

    public static $getStatusBadge = [
        self::ACTIVE => "bg-success",
        self::INACTIVE => "bg-danger",
    ];

    const NEWLEAD = 1;
    const KYCAPPROVED = 2;
    const CLIENT = 3;

    public static $getClientStatus = [
        self::NEWLEAD => "New Lead",
        self::KYCAPPROVED => "Kyc Approved",
        self::CLIENT => "Client",
    ];

    public static $getClientBadge = [
        self::NEWLEAD => "danger",
        self::KYCAPPROVED => "warning",
        self::CLIENT => "success",
    ];
    public static function removeImage($image, $path = "uploads")
    {
        $imgPath = public_path($path . '/' . $image);
        @unlink($imgPath);
        return true;
    }
    public static function getImagepath($type = 'dir')
    {
        $path = dirname(dirname(public_path())) . "/public";
        if ($type == "url") {
            $path = self::ADMIN_AVATAR_URL;
        }
        return $path;
    }
    public static function displayImage($image, $path = "uploads")
    {
        $imgPath = self::getImagepath('url') . "/images/profile.png";
        if ($image) {
            $imgPath = self::ADMIN_AVATAR_URL . $image; //self::getImagepath('url')."/".$path."/".$image;
        }
        return $imgPath;
    }
    public static function getsalesagents()
    {
        // return Auth::user()->admin_id;
        return User::where('admin_id', Auth::user()->admin_id)->where('role_id', config('constant.ADMIN_STAFF_ROLE'))->pluck('name', 'id')->toArray();
    }

    public static function getsalesAgentName($id)
    {
        $aRow = User::where('id', $id)->pluck('name')->first();
        return $aRow;
    }

    public static function uploadImage($image, $chkext = false, $destinationFolder = "uploads", $imgext)
    {
        // $image = base64_decode($image);
        // echo "<pre>";
        // print_r($image);
        // die;
        // $imageArray = array("png","jpg","jpeg","gif","bmp");
        // $imagename = "";
        // if($image)
        // {
        //     $imageext = $image->getClientOriginalExtension();
        //     $imgname = $image->getClientOriginalName();
        //     if(!in_array($imageext,$imageArray) && $chkext)
        //     {
        //         return "";
        //     }
        //     $imagename = rand(100,999).'_'.time().'.'.$imageext;

        //     $destinationPath = public_path($destinationFolder);
        //     $image->move($destinationPath, $imagename);
        // }
        // return  $imagename;
        $curl = curl_init();
        // echo $url = env('API_PATH')."api/upload";
        $url = "http://superadmin.websitetest.co.in/public/api/upload";

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('fileName' => new \CURLFILE($image), 'path' => $destinationFolder, 'imgext' => $imgext),
        ));

        $response = curl_exec($curl);
        // echo "<pre>";
        // print_r($curl);
        // die;
        // foreach($response as $resp){
        //     $data = $resp->data;
        // }
        // print_r($data);
        $data = json_decode($response);
        $image_name = $data->data;
        // dd($data);
        curl_close($curl);

        return $image_name;
    }

    public static function sendEmail($config = array())
    {
        $mailDriver = strtolower(config("mail.driver"));
        $response = false;
        try {
            $defaults = array_merge(array('sendAs' => 'html', 'template' => 'send', 'body' => 'No message', 'from' => 'no-reply@setupx.com', 'site' => 'setupx.com'), $config);
            $body = $defaults['body'];
            Mail::send('emails.' . $defaults['template'], ['title' => @$defaults['title'], 'link' => @$defaults['link'], 'body' => $body, 'extra' => (isset($defaults['extra']) ? $defaults['extra'] : [])], function ($message) use ($defaults) {
                $message->from($defaults['from'], $defaults['site']);
                $message->to($defaults['to']);
                $message->subject($defaults['subject']);
            });
            $response = true;
        } catch (Exception $e) {
        }
        return $response;
    }

    // public static function getAllPermissions($role_id = 0)
    // {
    //     $aModules = Permission::groupBy('module')->where('role', $role_id)->get();
    //      if($aModules)
    //      {
    //         foreach($aModules as $key => $aModule)
    //         {
    //             $aModules[$key]['permissions'] = Permission::where('module',$aModule->module)->get();
    //         }
    //     }
    //     return $aModules;
    // }
    public static function getAllPermissions($role_id = 0)
    {
        $super_admin_role = config('constant.SUPER_ADMIN_ROLE');
        $aModules = Permission::where('role', '!=', $super_admin_role)->groupBy('module')->get();
        if ($aModules) {
            foreach ($aModules as $key => $aModule) {
                $aModules[$key]['permissions'] = Permission::where('module', $aModule->module)->get();
            }
        }
        return $aModules;
    }

    public static function checkUserPermission($user_id = 0, $permission_id = 0)
    {
        $aRow = DB::table('model_has_permissions')->where('model_id', $user_id)->where('permission_id', $permission_id)->count();
        return $aRow;
    }

    public static function getSettingList()
    {
        $aRows = TabParameter::where('param_value', '>=', 201)->where('param_value', '<=', 300)->where('param_key', 'settings')->get();

        $aRow = array();
        foreach ($aRows as $key => $value) {
            $aRow[$value->param_name] = $value->param_description;
        }

        return $aRow;
    }

    public static function getContactMarketingList()
    {
        $aRows = TabParameter::where('param_value', '>=', 301)->where('param_value', '<=', 400)->where('param_key', 'contact_marketing')->get();
        $aRow = array();
        foreach ($aRows as $key => $value) {
            $aRow[$value->param_name] = $value->param_description;
        }

        return $aRow;
    }

    public static function getUserViewList()
    {
        $aRows = TabParameter::where('param_value', '>=', 301)->where('param_value', '<=', 400)->where('param_key', 'user_view')->get();
        $aRow = array();
        foreach ($aRows as $key => $value) {
            $aRow[$value->param_name] = $value->param_description;
        }

        return $aRow;
    }
    public static function getUserViewId($view_name)
    {
        $aRows = TabParameter::where('param_name', $view_name)->where('param_key', 'user_view')->first('param_value');
        return (isset($aRows->param_value)) ? $aRows->param_value : 0;
    }

    public function getStaffViewList()
    {
        $aRows = TabParameter::where('param_value', '>=', 301)->where('param_value', '<=', 400)->where('param_key', 'staff_view')->get();
        $aRow = array();
        foreach ($aRows as $key => $value) {
            $aRow[$value->param_name] = $value->param_description;
        }

        return $aRow;
    }

    public static function getStaffViewId($view_name)
    {
        $aRows = TabParameter::where('param_name', $view_name)->where('param_key', 'staff_view')->first('param_value');
        return (isset($aRows->param_value)) ? $aRows->param_value : 0;
    }

    public static function getLeadDocumentType($id)
    {
        $aRows = TabParameter::where('param_key', 'admin_doc_type')->where('param_value', $id)->pluck('param_name')->first();
        return $aRows;
    }
    public static function getStaffViewIcon($view_name)
    {
        $icon = "";
        if ($view_name == "Overview") {
            $icon = "fas fa-database";
        }
        if ($view_name == "Calls") {
            $icon = "fas fa-phone-alt";
        }
        if ($view_name == "Emails") {
            $icon = "fas fa-envelope-open";
        }
        if ($view_name == "Activity") {
            $icon = "fas fa-history";
        }
        if ($view_name == "EKYC") {
            $icon = "fas fa-file-alt";
        }
        if ($view_name == "Comments") {
            $icon = "far fa-comments";
        }
        if ($view_name == "Calender") {
            $icon = "far fa-calendar-alt";
        }
        if ($view_name == "Whatsapp") {
            $icon = "fab fa-whatsapp";
        }
        if ($view_name == "SMS") {
            $icon = "fas fa-sms";
        }

        return $icon;
    }

    public static function getUserViewIcon($view_name)
    {
        $icon = "";
        if ($view_name == "Overview") {
            $icon = "fas fa-database";
        }
        if ($view_name == "Files") {
            $icon = "fas fa-folder";
        }
        if ($view_name == "Tickets") {
            $icon = "fas fa-ticket-alt";
        }
        if ($view_name == "Deals") {
            $icon = "fas fa-rupee-sign";
        }
        if ($view_name == "Calls") {
            $icon = "fas fa-phone-alt";
        }
        if ($view_name == "Message") {
            $icon = "fas fa-envelope-open";
        }
        return $icon;
    }

    public static function getContactMarketingId($contact_name)
    {
        $aRows = TabParameter::where('param_name', $contact_name)->where('param_key', 'contact_marketing')->first('param_value');
        return (isset($aRows->param_value)) ? $aRows->param_value : 0;
    }
    public static function getSettingId($setting_name)
    {
        $aRows = TabParameter::where('param_name', $setting_name)->where('param_key', 'settings')->first('param_value');
        return (isset($aRows->param_value)) ? $aRows->param_value : 0;
    }

    public static function getdepartmentList()
    {
        $aRows = TabParameter::where('param_value', '>=', 101)->where('param_value', '<=', 200)->where('param_key', 'departments')->get();
        $departmentList = array();
        if ($aRows) {
            foreach ($aRows as $key => $value) {
                $departmentList[$value->param_value] = $value->param_name;
            }
        }

        return $departmentList;
    }
    public static function getdepartmentName($department_id)
    {

        $aRows = TabParameter::where('param_value', $department_id)->where('param_key', 'departments')->first('param_name');
        return (isset($aRows->param_name)) ? $aRows->param_name : '--';
    }

    public static function getCompanyLogo($admin_id)
    {
        $comp_logo = "";
        $logo = "";
        $logo_img = AdminSetting::where('admin_id', $admin_id)->get();
        if ($logo_img) {
            foreach ($logo_img as $key => $value) {
                if ($value->meta_key == "logo") {
                    $logo = $value->meta_value;
                }
            }
            $comp_logo = self::ADMIN_AVATAR_URL . $logo;
        } else {
            $logo_img = AdminDetail::where('admin_id', $admin_id)->where('meta_key', 'LIKE', 'c_logo')->pluck('meta_value')->first();
            $comp_logo = self::ADMIN_AVATAR_URL . $logo_img;
        }
        if (!$comp_logo) {
            $comp_logo = self::STAFF_AVATAR_URL . "logo-light.png";
        }
        // echo $comp_logo;die;
        return $comp_logo;
    }

    public static function getThemeSetting($admin_id)
    {
        $id = User::where('admin_id', $admin_id)->pluck('id')->first();
        $thene_setting = AdminSetting::where('admin_id', $admin_id)->where('created_by', $id)->get();
        foreach ($thene_setting as $key => $theme) {
            if ($theme->meta_key == "sitename") {
                Session::put('sitename', $theme->meta_value);
            }
        }
    }

    public static function StaffMail($aUser, $id)
    {
        $mailTemplate = AdminEmail::find($id);
        $templateParser = (new TemplateParser($mailTemplate->message));
        $templateParser->username = $aUser->name;
        $templateParser->email = $aUser->email;
        $templateParser->password = $aUser->password;
        $templateParser->process();
        Mail::to($aUser->email)->send(new SendMail($mailTemplate->subject, $templateParser->getCompiled()));
    }

    public static function activityFeed($data)
    {
        $aVals['type'] = 0;
        $aVals['activity_type'] = $data['activity_type'];
        $aVals['admin_id'] = Auth::user()->admin_id;
        $aVals['user_id'] = $data['user_id'];
        $aVals['activity_msg'] = $data['activity_msg'];
        $aVals['created_by'] = Auth::user()->id;
        $aVals['updated_by'] = Auth::user()->id;
        $activity = Activity::create($aVals);

        return true;
    }

    public function getEventReminderTime($ss)
    {

        $alert = [
            "30" => "30 Minutes before",
            "60" => "1 Hour before",
            "1440" => "1 Day before",
            "10080" => "1 Week before",
        ];

        return $alert[$ss];
    }

    public static function getCalendarList()
    {
        // $aRows = TabParameter::where('param_value', '>=', 101)->where('param_value', '<=',  200)->where('param_key', 'departments')->get();
        // $departmentList = array();
        // if($aRows){
        //     foreach ($aRows as $key => $value) {
        //         $departmentList[$value->param_value] = $value->param_name;
        //     }
        // }

        $calendarList = ["1" => "Work", "2" => "Personal"];

        return $calendarList;
    }

    public static function getAlertList()
    {
        // $aRows = TabParameter::where('param_value', '>=', 101)->where('param_value', '<=',  200)->where('param_key', 'departments')->get();
        // $departmentList = array();
        // if($aRows){
        //     foreach ($aRows as $key => $value) {
        //         $departmentList[$value->param_value] = $value->param_name;
        //     }
        // }

        $alertList = [
            "30" => "30 Minutes before",
            "60" => "1 Hour before",
            "1440" => "1 Day before",
            "10080" => "1 Week before",
        ];

        return $alertList;
    }

    public static function getParameterId($data)
    {
        // echo $data;die;
        $param_value = TabParameter::where('param_name', 'LIKE', '%' . $data . '%')->pluck('param_value')->first();
        return $param_value;
    }

    public static function incomeDataList()
    {
        $aRows = TabParameter::where('param_value', '>=', 701)->where('param_value', '<=', 800)->where('param_key', 'income_data')->get();
        $departmentList = array();
        if ($aRows) {
            foreach ($aRows as $key => $value) {
                $departmentList[$value->param_value] = $value->param_name;
            }
        }

        return $departmentList;
    }

    public static function empStatusList()
    {
        $aRows = TabParameter::where('param_value', '>=', 701)->where('param_value', '<=', 800)->where('param_key', 'emp_status')->get();
        $departmentList = array();
        if ($aRows) {
            foreach ($aRows as $key => $value) {
                $departmentList[$value->param_value] = $value->param_name;
            }
        }

        return $departmentList;
    }

    public static function incomeSourceList()
    {
        $aRows = TabParameter::where('param_value', '>=', 701)->where('param_value', '<=', 800)->where('param_key', 'source_income')->get();
        $departmentList = array();
        if ($aRows) {
            foreach ($aRows as $key => $value) {
                $departmentList[$value->param_value] = $value->param_name;
            }
        }

        return $departmentList;
    }

    public static function expStatusList()
    {
        $aRows = TabParameter::where('param_value', '>=', 701)->where('param_value', '<=', 800)->where('param_key', 'exp_status')->get();
        $departmentList = array();
        if ($aRows) {
            foreach ($aRows as $key => $value) {
                $departmentList[$value->param_value] = $value->param_name;
            }
        }

        return $departmentList;
    }
}
