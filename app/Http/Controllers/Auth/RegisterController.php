<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\CustomHelper;
use App\Helpers\MailHelper;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Client;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function clientRegister($id)
    {
        return view('auth1.register', compact('id'));
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'dob' => ['required', 'date', 'before:today'],
            'avatar' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if (request()->has('avatar')) {
            $avatar = request()->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = public_path('/images/');
            $avatar->move($avatarPath, $avatarName);
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'dob' => date('Y-m-d', strtotime($data['dob'])),
            'avatar' => "/images/" . $avatarName,
        ]);
    }

    public function storeClientRegister(Request $request, $id)
    {
        $aVals = $request->all();
        $messages = [
            'first_name.required' => 'Please enter the first name',
            'last_name.required' => 'Please enter the last name',
            'email.required' => 'Please enter the email',
            'paassword.required' => "Password is required",
            'email.unique' => "Email Already Exist",
        ];
        $rules = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:clients|unique:users',
            'password' => 'required_with:password_confirmation|min:8|string|confirmed',
        ];
        $this->validate($request, $rules, $messages);
        $check_email = User::where('email', $aVals['email'])->count();
        if ($check_email) {
            return redirect()->back()->with('error', 'Email Already Exists');
        }
        // echo $id;
        // echo "<pre>";
        // print_r($aVals);
        // die;
        // dd($aVals);
        $user = User::where('admin_id', $id)->first();
        $clientData['admin_id'] = isset($aVals['admin_id']) ? $aVals['admin_id'] : $id;
        $clientData['first_name'] = isset($aVals['first_name']) ? $aVals['first_name'] : null;
        $clientData['last_name'] = isset($aVals['last_name']) ? $aVals['last_name'] : null;
        $clientData['email'] = isset($aVals['email']) ? $aVals['email'] : null;
        $clientData['status'] = 1;
        $clientData['dob'] = isset($aVals['dob']) ? date('y-m-d', strtotime($aVals['dob'])) : null;
        $clientData['created_by'] = $user->id;
        $clientData['updated_by'] = $user->id;
        $client = Client::create($clientData);
        if ($client) {
            $userData['admin_id'] = isset($aVals['admin_id']) ? $aVals['admin_id'] : $id;
            $userData['client_id'] = $client->id;
            $userData['name'] = $clientData['first_name'] . $clientData['last_name'];
            $userData['email'] = isset($aVals['email']) ? $aVals['email'] : null;
            $userData['dob'] = isset($aVals['dob']) ? date('y-m-d', strtotime($aVals['dob'])) : null;
            $userData['password'] = Hash::make($aVals['password']);
            $userData['role_id'] = 3;
            $userData['created_by'] = $user->id;
            $userData['updated_by'] = $user->id;
            if ($request->hasFile('avatar')) {
                $imageext = $request->file('avatar')->getClientOriginalExtension();
                // echo $imageext;die;
                $userData['avatar'] = CustomHelper::uploadImage($request->file('avatar'), true, 'uploads/admin_doc/', $imageext);
            }
            $userData['status'] = 1;
            // echo "<pre>";
            // print_r($userData);
            // die;
            $user = User::create($userData);
            if ($user) {
                $admin = User::where('admin_id', $id)->first();
                $data['activity_type'] = CustomHelper::ACTIVITYLEAD;
                $data['user_id'] = $user->id;
                $data['activity_msg'] = "Lead" . $client->first_name . $client->last_name . "form was updated";
                $data['type'] = 0;
                $data['admin_id'] = $id;
                $data['created_by'] = $admin->id;
                $data['updated_by'] = $admin->id;
                Activity::create($data);
                MailHelper::LeadMail($request, 5);
                return redirect('login');
            } else {
                return redirect()->back()->with('error', 'Failed To Register The User');
            }
        } else {
            return redirect()->back()->with('error', 'Failed To Register The User');
        }

    }
}
