<?php

namespace App\Http\Controllers;

use App\Helpers\CustomHelper;
use App\Models\City;
use App\Models\Client;
use App\Models\ClientDocument;
use App\Models\Country;
use App\Models\State;
use App\Models\TabParameter;
use App\Models\Timezone;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->aCountry = Country::get()->pluck('name', 'id')->toArray();
        $this->aState = State::get()->pluck('name', 'id')->toArray();
        $this->aCity = City::get()->pluck('name', 'id')->toArray();
        $this->aTimezone = Timezone::get()->pluck('name', 'id')->toArray();
        $this->incomeData = CustomHelper::incomeDataList();
        $this->empStatus = CustomHelper::empStatusList();
        $this->sourceIncome = CustomHelper::incomeSourceList();
        $this->expStatus = CustomHelper::expStatusList();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $viewPath = "htmlpages/" . $request->path();
        if (view()->exists($viewPath)) {
            return view($viewPath);
        }
        return abort(404);
    }

    public function root()
    {
        $admin_id = Auth::user()->admin_id;
        CustomHelper::getThemeSetting($admin_id);
        if (Auth::user()->role_id == config('constant.CLIENT_ROLE')) {
            return view('client-index');
        }
        return view('index');
    }

    /*Language Translation*/
    public function lang($locale)
    {
        if ($locale) {
            App::setLocale($locale);
            Session::put('lang', $locale);
            Session::save();
            return redirect()->back()->with('locale', $locale);
        } else {
            return redirect()->back();
        }
    }

    public function updateProfile(Request $request, $id)
    {
        $aVals = $request->all();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
        ]);
        $userData['name'] = isset($aVals['name']) ? $aVals['name'] : null;
        $userData['email'] = isset($aVals['email']) ? $aVals['email'] : null;
        $userData['dob'] = isset($aVals['dob']) ? date('y-m-d', strtotime($aVals['dob'])) : null;
        if ($request->file('avatar')) {
            $imageext = $request->file('avatar')->getClientOriginalExtension();
            $userData['avatar'] = CustomHelper::uploadImage($request->file('avatar'), true, 'uploads/admin_doc/', $imageext);
        }
        // echo "CHECK";
        // echo "<pre>";
        // print_r($userData);
        // die;
        $user = User::where('id', $id)->update($userData);
        if ($user) {
            Session::flash('message', 'User Details Updated successfully!');
            Session::flash('alert-class', 'alert-success');
            return response()->json([
                'isSuccess' => true,
                'Message' => "User Details Updated successfully!",
            ], 200); // Status code here
        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
            return response()->json([
                'isSuccess' => true,
                'Message' => "Something went wrong!",
            ], 200); // Status code here
        }
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            return response()->json([
                'isSuccess' => false,
                'Message' => "Your Current password does not matches with the password you provided. Please try again.",
            ], 200); // Status code
        } else {
            $user = User::find($id);
            $user->password = Hash::make($request->get('password'));
            $user->update();
            if ($user) {
                Session::flash('message', 'Password updated successfully!');
                Session::flash('alert-class', 'alert-success');
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Password updated successfully!",
                ], 200); // Status code here
            } else {
                Session::flash('message', 'Something went wrong!');
                Session::flash('alert-class', 'alert-danger');
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Something went wrong!",
                ], 200); // Status code here
            }
        }
    }

    public function contactProfile()
    {
        $aRow = array();
        $eKyc = array();
        $type_array = array();
        $docType = array();
        if (Auth::user()->role_id == config('constant.CLIENT_ROLE')) {
            $id = Auth::user()->client_id;
            $aRow = Client::where('id', $id)->first();
            $eKyc = ClientDocument::where('client_id', $id)->get();
            foreach ($eKyc as $kyc) {
                $type_array[] = $kyc->doc_type;
            }
            $docType = TabParameter::whereNotIn('param_value', $type_array)->where('param_key', 'admin_doc_type')->pluck('param_name', 'param_value')->toArray();
        }
        $aCountry = $this->aCountry;
        $aState = $this->aState;
        $aCity = $this->aCity;
        $aTimezone = $this->aTimezone;
        $incomeData = $this->incomeData;
        $empStatus = $this->empStatus;
        $sourceIncome = $this->sourceIncome;
        $expStatus = $this->expStatus;

        // $clientStatus = $this->clientStatus;
        return view('htmlpages.contacts-profile', compact('aRow', 'aCountry'
            , 'aState', 'aCity', 'aTimezone', 'incomeData', 'empStatus', 'sourceIncome'
            , 'expStatus', 'eKyc', 'type_array', 'docType'));
    }

}
