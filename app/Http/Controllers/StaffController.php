<?php

namespace App\Http\Controllers;

use App\Helpers\CustomHelper;
use App\Helpers\MailHelper;
use App\Models\Activity;
use App\Models\Message;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:admin_staff_list|admin_staff_create|admin_staff_edit|admin_staff_destroy', ['only' => ['index', 'show']]);
        $this->middleware('permission:admin_staff_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:admin_staff_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:admin_staff_destroy', ['only' => ['destroy']]);
        $this->middleware('permission:admin_staff_status', ['only' => ['status']]);
        $this->emailType = 7;
    }

    protected function validator(Request $request, $isEdit = 0)
    {
        $aValids = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ];
        if ($request->password) {
            $aValids['password'] = ['required_with:password_confirmation|min:8|string|confirmed'];
        }

        if ($isEdit > 0) {
            $this->isEdit = $isEdit;
            $aValids['name'] = ['required', 'string', 'max:255,fname,' . $isEdit];
            $aValids['email'] = ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $isEdit];
        }

        $this->validate($request, $aValids);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->all();
        $admin_staff_role = config('constant.ADMIN_STAFF_ROLE');
        $admin_role = config('constant.ADMIN_ROLE');
        if (Auth::user()->role_id == $admin_role) {
            $aUsers = User::where('admin_id', Auth::user()->admin_id)->where('role_id', $admin_staff_role);
        } else {
            $aUsers = User::where('created_by', Auth::user()->id)->where('role_id', $admin_staff_role);
        }

        if(isset($filter['name'])){
            $aUsers = $aUsers->where('name', 'LIKE', "%{$filter['name']}%");
        }
        
        if(isset($filter['email'])){
            $aUsers = $aUsers->where('email', 'LIKE', "%{$filter['email']}%");
        }

        $aUsers = $aUsers->paginate(20);

        $aUsers->appends(['name' => @$filter['name'], 'email' => @$filter['email']]);
        
        return view('staff.index', compact('aUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $aRow = array();
        $aPermissions = CustomHelper::getAllPermissions(1);

        return view('staff/add', compact('aRow', 'aPermissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aPosts = $request->all();
        $this->validator($request);
        // dd($request->all());
        $aUser = $this->savestaff($request);
        if ($aUser) {
            MailHelper::StaffMail($request, $this->emailType);
        }
        return redirect('staff')->with('message', 'New Staff Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aRow = User::findorfail($id);
        $aPermissions = CustomHelper::getAllPermissions(1);

        return view('staff.overview', compact('aRow', 'aPermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aRow = User::findOrFail($id);
        $aPermissions = CustomHelper::getAllPermissions(1);
        // echo "<pre>";
        // print_r($aPermissions);
        // die;
        return view('staff/add', compact('aRow', 'aPermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $aPosts = $request->all();
        $this->validator($request, $id);
        $aUser = $this->savestaff($request, $id);
        return redirect('staff')->with('message', 'User updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aRow = User::findOrFail($id);
        $aRow->delete();
        return redirect('staff')->with('message', 'Staff deleted Successfully.');
    }

    public function status($id, $status)
    {
        $user = User::find($id)->update(['status' => $status]);
        return redirect('staff')->with('message', 'Staff status updated Successfully.');
    }

    private function savestaff(Request $request, $id = 0)
    {
        $aPosts = $request->all();
        $aPosts['updated_by'] = Auth::user()->id;
        $aPosts['updated_at'] = DB::raw('CURRENT_TIMESTAMP');
        if (isset($aPosts['password'])) {
            $aPosts['password'] = Hash::make($aPosts['password']);
        } else {
            unset($aPosts['password']);
        }

        if ($request->hasFile('avatar')) {
            $imageext = $request->file('avatar')->getClientOriginalExtension();
            // echo $imageext;die;
            $aPosts['avatar'] = CustomHelper::uploadImage($request->file('avatar'), true, 'uploads/admin_doc/', $imageext);
        }

        if (isset($id) && $id > 0) {
            $aUser = User::find($id);
            $aUser->update($aPosts);
            $data['user_id'] = $id;
            $data['activity_type'] = CustomHelper::ACTIVITYACCOUNT;
            $data['activity_msg'] = "Account for user " . $aUser->name . " was updated";
            // echo "<pre>";
            // print_r($data);
            // die;
            CustomHelper::activityFeed($data);
        } else {
            $aPosts['status'] = 1;
            $aPosts['admin_id'] = Auth::user()->admin_id;
            $aPosts['role_id'] = config('constant.ADMIN_STAFF_ROLE');
            $aPosts['created_by'] = Auth::user()->id;
            $aPosts['created_at'] = DB::raw('CURRENT_TIMESTAMP');
            $aPosts['ip_address'] = $_SERVER['REMOTE_ADDR'];
            // dd($aPosts);
            $aUser = User::create($aPosts);
            $data['user_id'] = $aUser->id;
            $data['activity_type'] = CustomHelper::ACTIVITYACCOUNT;
            $data['activity_msg'] = "Account for user" . $aUser->name . "was created";
            CustomHelper::activityFeed($data);
        }
        // echo "<pre>";
        // print_r($request->permissions);
        // die;
        @$aUser->syncPermissions($request->permissions);

        return true;

    }

    public function userShow(Request $request)
    {
        $id = $request->id;
        // echo $id;
        $viewName = $request->key;
        // echo $viewName;die;
        $settingId = CustomHelper::getUserViewId($request->key);
        if ($settingId == 0) {
            return redirect()->back()->with('error', 'Invalid Attempt');
        }
        $admin_id = Auth::user()->admin_id;
        // $aRow
        $aRow = User::where('id', $request->id)->first();
        $aPermissions = CustomHelper::getAllPermissions(1);
        $ticket = array();
        $message = array();
        $activity = array();
        $account = array();
        if ($viewName == "Overview") {
            $activity = Activity::where('user_id',$request->id)->get();
            $account = Activity::where('activity_type', 4)->where('user_id', $id)->get();
        }
        if ($viewName == "Files") {
            $icon = "fas fa-folder";
        }
        if ($viewName == "Tickets") {
            $ticket = Ticket::where('created_by', $request->id)->paginate(10);
        }
        if ($viewName == "Deals") {
            $icon = "fas fa-rupee-sign";
        }
        if ($viewName == "Calls") {
            $icon = "fas fa-phone-alt";
        }
        if ($viewName == "Message") {
            $message = Message::join('users', 'users.id', '=', 'messages.user_id')->join('message_replies', 'message_replies.message_id', '=', 'messages.id')->where('messages.user_id', $id)->select('users.name', 'message_replies.*')->orderBy('message_replies.created_at', 'DESC')->get();
            foreach ($message as $key => $msg) {
                $message[$key]['reply_by'] = User::where('id', $msg->reply_by)->pluck('name')->first();
            }
        }
        // echo "<pre>";
        // print_r($activity);
        // die;
        return view('staff.' . $viewName, compact('aRow', 'viewName', 'settingId', 'id', 'aPermissions', 'ticket', 'message', 'activity', 'account'));
    }
}
