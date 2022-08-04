<?php

namespace App\Http\Controllers;

use App\Helpers\CustomHelper;
use App\Models\AdminEmailSetting;
use App\Models\AdminSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneralSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:admin_setting', ['only' => ['index', 'show']]);
        $this->middleware('permission:admin_email_create', ['only' => ['create', 'store']]);
    }
    protected function validator(Request $request, $isEdit = 0)
    {
        $aValids = [
            'logo.*' => ['required', 'mimes:jpeg,bmp,png,gif,jpg'],
            'sitename' => ['required'],
            'login_title' => ['required'],
            'appname' => ['required'],
            'apptagline' => ['required'],
            'site_author' => ['required'],
            'sitekeywords' => ['required'],
            'sitedescription' => ['required'],
        ];

        $this->validate($request, $aValids, []);
    }

    public function index(Request $request, $settingName)
    {
        $settingId = CustomHelper::getSettingId($settingName);
        if ($settingId == 0) {
            return redirect()->back()->with('error', 'Invalid Attempt');
        }
        $admin_id = Auth::user()->admin_id;
        $id = Auth::user()->id;
        $aRows = AdminSetting::where('setting_group', $settingId)->where('admin_id', $admin_id)->where('created_by', $id)->get();
        $aRow = array();
        foreach ($aRows as $key => $value) {
            $aRow[$value->meta_key] = $value->meta_value;
        }

        return view('setting.' . $settingName, compact('aRow', 'settingName', 'settingId'));
    }

    public function store(Request $request, $settingId)
    {
        // $this->validator($request);
        $aVals = $request->all();
        $admin_id = Auth::user()->admin_id;
        $id = Auth::user()->id;
        // dd($aVals);
        unset($aVals['_token']);
        if ($aVals) {
            foreach ($aVals as $aKey => $aVal) {
                $aSetting = AdminSetting::where('meta_key', $aKey)->where('setting_group', $settingId)->where('created_at', $id)->first();
                if ($aKey == 'logo') {
                    if ($request->hasFile('logo')) {
                        $imageext = $request->file('logo')->getClientOriginalExtension();
                        $files = $request->file('logo');
                        $oldImage = (isset($aSetting->meta_value)) ? $aSetting->meta_value : false;
                        // $result = CustomHelper::uploadImage($files, 'sitesetting', false, 'image', $oldImage);
                        $result = CustomHelper::uploadImage($request->file('logo'), false, 'uploads/admin_doc', $imageext);
                        if (!$result) {
                            return back()->with("error", 'Please add valid file type');
                        }
                        $aVal = $result;
                        // if(Session::has('logo')){
                        //     Session::forget('logo');
                        //     Session::push('logo',$result);
                        // }else{
                        //     Session::push('logo',$result);
                        // }
                    }
                }
                if ($aKey == 'site_favicon') {
                    if ($request->hasFile('site_favicon')) {
                        $imageext = $request->file('site_favicon')->getClientOriginalExtension();
                        $files = $request->file('site_favicon');
                        $oldIcon = (isset($aSetting->meta_key)) ? $aSetting->meta_key : false;

                        $result = CustomHelper::uploadImage($request->file('site_favicon'), false, 'icon', $imageext);
                        if (!$result) {
                            return back()->with("error", 'Please add valid file type');
                        }
                        $aVal = $result;
                    }
                }
                if ($aSetting) {
                    $aSetting->update(array('meta_value' => $aVal));
                } else {
                    $aOpt['admin_id'] = Auth::user()->admin_id;
                    $aOpt['setting_group'] = $settingId;
                    $aOpt['meta_key'] = $aKey;
                    $aOpt['meta_value'] = isset($aVal) ? $aVal : "";
                    $aOpt['created_by'] = Auth::user()->id;
                    $aOpt['updated_by'] = Auth::user()->id;
                    AdminSetting::create($aOpt);
                }
            }
        }

        return redirect()->back()->with('message', 'Setting updated Successfully.');
    }

    public function emailConfiguration(Request $request)
    {
        $aVals = $request->all();
        // dd($aVals);
        $messages = [
            'driver.required' => "Please enter the driver",
            'host.required' => "Please enter the host",
            'port.required' => "Please enter the port",
            'encryption.required' => "Please enter the encryption",
            'username.required' => "Please enter the username",
            'password.required' => "Please enter the password",
            'sender_email.required' => "Please enter the send_email",
            'sender_name.required' => "Please enter the sender_name",
        ];
        $rules = [
            'driver' => "required|string",
            'host' => "required|string",
            'port' => "required|integer",
            'encryption' => "required|string",
            'username' => "required|email",
            'password' => "required",
            'sender_email' => "required|email",
            'sender_name' => "required|string",
        ];
        $this->validate($request, $rules, $messages);
        $ecSetting["admin_id"] = Auth::user()->admin_id;
        $ecSetting["driver"] = isset($aVals['driver']) ? $aVals['driver'] : null;
        $ecSetting["host"] = isset($aVals['host']) ? $aVals['host'] : null;
        $ecSetting["port"] = isset($aVals['port']) ? $aVals['port'] : null;
        $ecSetting["encryption"] = isset($aVals['encryption']) ? $aVals['encryption'] : null;
        $ecSetting["username"] = isset($aVals['username']) ? $aVals['username'] : null;
        $ecSetting["password"] = isset($aVals['password']) ? $aVals['password'] : null;
        $ecSetting["sender_email"] = isset($aVals['sender_email']) ? $aVals['sender_email'] : null;
        $ecSetting["sender_name"] = isset($aVals['sender_name']) ? $aVals['sender_name'] : null;
        $ecSetting["created_by"] = Auth::user()->id;
        $ecSetting["updated_by"] = Auth::user()->id;

        $emailSetting = AdminEmailSetting::create($ecSetting);

        if ($emailSetting) {
            return redirect()->back()->with('message', 'Email Configuration Updated Successfully');
        } else {
            return redirect()->back()->with('error', 'Failed To Update Email Configuration');
        }
    }
}
