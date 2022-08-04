<?php

namespace App\Http\Controllers;

use App\Helpers\CustomHelper;
use App\Helpers\MailHelper;
use App\Models\City;
use App\Models\Client;
use App\Models\Country;
use App\Models\State;
use App\Models\TabParameter;
use App\Models\Timezone;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:client_list|client_create|client_edit|client_destroy', ['only' => ['index', 'show']]);
        $this->middleware('permission:client_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:client_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:client_destroy', ['only' => ['destroy']]);
        $this->middleware('permission:client_status', ['only' => ['status']]);
        $this->aCountry = Country::get()->pluck('name', 'id')->toArray();
        $this->aState = State::get()->pluck('name', 'id')->toArray();
        $this->aCity = City::get()->pluck('name', 'id')->toArray();
        $this->aTimezone = Timezone::get()->pluck('name', 'id')->toArray();
        $this->aSource = Client::$getSource;
        $this->aStage = Client::$getStage;
        $this->salesAgent = Client::$getSalesAgent;
        $this->clientStatus = CustomHelper::$getClientStatus;
        $this->incomeData = CustomHelper::incomeDataList();
        $this->empStatus = CustomHelper::empStatusList();
        $this->sourceIncome = CustomHelper::incomeSourceList();
        $this->expStatus = CustomHelper::expStatusList();
        $this->emailType = TabParameter::where('param_key', 'admin_email_type')->pluck('param_name', 'param_value')->toArray();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->all();
        // echo "<pre>";
        // print_r($filter);
        // die;

        $aCountry = $this->aCountry;
        $aState = $this->aState;
        $aCity = $this->aCity;
        $aTimezone = $this->aTimezone;
        $aSource = $this->aSource;
        $aStage = $this->aStage;
        $salesAgent = $this->salesAgent;
        $clientStatus = $this->clientStatus;
        $incomeData = $this->incomeData;
        $empStatus = $this->empStatus;
        $sourceIncome = $this->sourceIncome;
        $expStatus = $this->expStatus;


        if (Auth::user()->role_id == config('constant.ADMIN_ROLE')) {
            $admin_id = Auth::user()->admin_id;
            $aLeads = Client::where('admin_id', $admin_id);
            $today = Client::whereDate('created_at', Carbon::today())->where('admin_id', $admin_id)->count();
            $week = Client::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('admin_id', $admin_id)->count();
            $month = Client::whereMonth('created_at', Carbon::now()->month)->where('admin_id', $admin_id)->count();
        } else {
            $aLeads = Client::where('created_by', Auth::user()->id);
            $today = Client::where('created_by', Auth::user()->id)->whereDate('created_at', Carbon::today())->count();
            $week = Client::where('created_by', Auth::user()->id)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
            $month = Client::where('created_by', Auth::user()->id)->whereMonth('created_at', Carbon::now()->month)->count();
        }

        if(isset($filter['name'])){
            $aLeads = $aLeads->where('first_name', 'LIKE', "%{$filter['first_name']}%");
        }
        if(isset($filter['email'])){
            $aLeads = $aLeads->where('email', 'LIKE', "%{$filter['email']}%");
        }
        if(isset($filter['contact'])){
            $aLeads = $aLeads->where('contact', 'LIKE', "%{$filter['contact']}%");
        }
        if(isset($filter['country_id'])){
            $aLeads = $aLeads->where('country_id',$filter['country_id']);
        }
        if(isset($filter['state_id'])){
            $aLeads = $aLeads->where('state_id',$filter['state_id']);
        }
        if(isset($filter['city_id'])){
            $aLeads = $aLeads->where('city_id',$filter['city_id']);
        }
        if(isset($filter['nationality'])){
            $aLeads = $aLeads->where('nationality', 'LIKE', "%{$filter['nationality']}%");
        }
        if(isset($filter['company_name'])){
            $aLeads = $aLeads->where('company_name', 'LIKE', "%{$filter['company_name']}%");
        }
        if(isset($filter['dob'])){
            $aLeads = $aLeads->whereDate('dob',$filter['dob']);
        }
        if(isset($filter['net_worth'])){
            $aLeads = $aLeads->where('net_worth',$filter['net_worth']);
        }
        if(isset($filter['annual_income'])){
            $aLeads = $aLeads->where('annual_income',$filter['annual_income']);
        }
        if(isset($filter['emp_status'])){
            $aLeads = $aLeads->where('emp_status',$filter['emp_status']);
        }
        if(isset($filter['source_income'])){
            $aLeads = $aLeads->where('source_income',$filter['source_income']);
        }
        if(isset($filter['initial_amt'])){
            $aLeads = $aLeads->where('initial_amt',$filter['initial_amt']);
        }
        $aLeads = $aLeads->paginate(20);

        $aLeads->appends(["name" => @$filter['name'],"email" => @$filter['email'],"contact" => @$filter['contact'],"country_id" => @$filter['country_id'],"state_id" => @$filter['state_id'],"city_id" => @$filter['city_id'],"nationality" => @$filter['nationality'],"company_name" => @$filter['company_name'],"dob" => @$filter['dob'],"net_worth" => @$filter['net_worth'],"annual_income" => @$filter['annual_income'],"emp_status" => @$filter['emp_status'],"source_income" => @$filter['source_income'],"initial_amt" => @$filter['initial_amt']]);
        // echo "<pre>";
        // print_r($aLeads);
        // die;
        $total_leads = count($aLeads);
        $cStatus = $this->clientStatus;

        return view('clients.index', compact('aLeads', 'total_leads', 'today', 'week', 'month', 'cStatus', 'aCountry', 'aState', 'aCity', 'aTimezone', 'aSource', 'aStage', 'salesAgent', 'clientStatus', 'incomeData', 'empStatus', 'sourceIncome', 'expStatus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $aCountry = $this->aCountry;
        $aState = $this->aState;
        $aCity = $this->aCity;
        $aTimezone = $this->aTimezone;
        $aSource = $this->aSource;
        $aStage = $this->aStage;
        $salesAgent = $this->salesAgent;
        $clientStatus = $this->clientStatus;
        $incomeData = $this->incomeData;
        $empStatus = $this->empStatus;
        $sourceIncome = $this->sourceIncome;
        $expStatus = $this->expStatus;
        $aRow = array();

        return view('clients.add', compact('aCountry', 'aState', 'aCity', 'aTimezone', 'aRow', 'aSource', 'aStage', 'salesAgent', 'clientStatus', 'incomeData', 'empStatus', 'sourceIncome', 'expStatus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aVals = $request->all();
        // dd($aVals);
        $messages = [
            'first_name.required' => 'Please enter the first name',
            'last_name.required' => 'Please enter the last name',
            'email.required' => 'Please enter the email',
            'contact.required' => 'Please enter the contact number',
            'address_1.required' => 'Please enter full address',

        ];
        $rules = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'contact' => 'required|integer',
            'address_1' => 'required',
        ];
        $this->validate($request, $rules, $messages);
        // if(Auth::user()->role_id == config('constant.ADMIN_ROLE')){
        //     // $clientData['admin_id'] = ;
        // }else{
        //     $aLeads = Client::where('created_by',Auth::user()->id)->get();
        // }
        $clientData['admin_id'] = Auth::user()->admin_id;
        $clientData['first_name'] = isset($aVals['first_name']) ? $aVals['first_name'] : null;
        $clientData['last_name'] = isset($aVals['last_name']) ? $aVals['last_name'] : null;
        $clientData['email'] = isset($aVals['email']) ? $aVals['email'] : null;
        $clientData['contact'] = isset($aVals['contact']) ? $aVals['contact'] : null;
        $clientData['company_name'] = isset($aVals['company_name']) ? $aVals['company_name'] : null;
        $clientData['country'] = isset($aVals['country']) ? $aVals['country'] : null;
        $clientData['country_id'] = isset($aVals['country_id']) ? $aVals['country_id'] : null;
        $clientData['state_id'] = isset($aVals['state_id']) ? $aVals['state_id'] : null;
        $clientData['city_id'] = isset($aVals['city_id']) ? $aVals['city_id'] : null;
        $clientData['net_worth'] = isset($aVals['net_worth']) ? $aVals['net_worth'] : null;
        $clientData['annual_income'] = isset($aVals['annual_income']) ? $aVals['annual_income'] : null;
        $clientData['emp_status'] = isset($aVals['emp_status']) ? $aVals['emp_status'] : null;
        $clientData['dob'] = isset($aVals['dob']) ? date('y-m-d', strtotime($aVals['dob'])) : null;
        $clientData['address_1'] = isset($aVals['address_1']) ? $aVals['address_1'] : null;
        $clientData['address_2'] = isset($aVals['address_2']) ? $aVals['address_2'] : null;
        $clientData['source_income'] = isset($aVals['source_income']) ? $aVals['source_income'] : null;
        $clientData['invest_known'] = isset($aVals['invest_known']) ? $aVals['invest_known'] : null;
        $clientData['objective_exp'] = isset($aVals['objective_exp']) ? $aVals['objective_exp'] : null;
        $clientData['nationality'] = isset($aVals['nationality']) ? $aVals['nationality'] : null;
        $clientData['previous_exp'] = isset($aVals['previous_exp']) ? $aVals['previous_exp'] : null;
        $clientData['initial_amt'] = isset($aVals['initial_amt']) ? $aVals['initial_amt'] : null;
        $clientData['status'] = isset($aVals['status']) ? $aVals['status'] : 1;
        $clientData['created_by'] = Auth::user()->id;
        $clientData['updated_by'] = Auth::user()->id;
        // dd($clientData);
        $client = Client::create($clientData);
        $userData['admin_id'] = Auth::user()->admin_id;
        $userData['client_id'] = $client->id;
        $userData['name'] = $clientData['first_name'] . $clientData['last_name'];
        $userData['email'] = $clientData['email'];
        $userData['password'] = isset($aVals['password']) ? Hash::make($aVals['password']) : null;
        $userData['dob'] = $clientData['dob'];
        $userData['role_id'] = config('constant.CLIENT_ROLE');
        $userData['status'] = 0;
        $userData['created_by'] = Auth::user()->id;
        $userData['updated_by'] = Auth::user()->id;
        if ($client) {
            $user = User::create($userData);
            $data['activity_type'] = CustomHelper::ACTIVITYLEAD;
            $data['user_id'] = Auth::user()->id;
            $data['activity_msg'] = "Lead for " . $client->first_name . $client->last_name . " form was created";
            CustomHelper::activityFeed($data);
            MailHelper::LeadMail($request, 5);
            return redirect()->route('leads.index')->with('message', 'Lead Added Successfully');
        } else {
            return redirect()->route('leads.index')->with('error', 'Failed To Add Lead');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aRow = Client::findorfail($id);

        return view('clients.Overview', compact('aRow'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aCountry = $this->aCountry;
        $aState = $this->aState;
        $aCity = $this->aCity;
        $aTimezone = $this->aTimezone;
        $aSource = $this->aSource;
        $aStage = $this->aStage;
        $salesAgent = $this->salesAgent;
        $clientStatus = $this->clientStatus;
        $incomeData = $this->incomeData;
        $empStatus = $this->empStatus;
        $sourceIncome = $this->sourceIncome;
        $expStatus = $this->expStatus;
        $aRow = Client::where('id', $id)->first();
        // $aRow = Client::join('tab_parameter')

        return view('clients.add', compact('aCountry', 'aState', 'aCity', 'aTimezone', 'aRow', 'aSource', 'aStage', 'salesAgent', 'clientStatus', 'incomeData', 'empStatus', 'sourceIncome', 'expStatus'));
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
        $aVals = $request->all();
        // dd($aVals);
        $messages = [
            'first_name.required' => 'Please enter the first name',
            'last_name.required' => 'Please enter the last name',
            'email.required' => 'Please enter the email',
            'contact.required' => 'Please enter the contact number',
            'address_1.required' => 'Please enter full address',

        ];
        $rules = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'contact' => 'required|integer',
            'address_1' => 'required',
        ];
        $this->validate($request, $rules, $messages);
        // if(Auth::user()->role_id == config('constant.ADMIN_ROLE')){
        //     // $clientData['admin_id'] = ;
        // }else{
        //     $aLeads = Client::where('created_by',Auth::user()->id)->get();
        // }
        $clientData['admin_id'] = Auth::user()->admin_id;
        $clientData['first_name'] = isset($aVals['first_name']) ? $aVals['first_name'] : null;
        $clientData['last_name'] = isset($aVals['last_name']) ? $aVals['last_name'] : null;
        $clientData['email'] = isset($aVals['email']) ? $aVals['email'] : null;
        $clientData['contact'] = isset($aVals['contact']) ? $aVals['contact'] : null;
        $clientData['company_name'] = isset($aVals['company_name']) ? $aVals['company_name'] : null;
        $clientData['country'] = isset($aVals['country']) ? $aVals['country'] : null;
        $clientData['country_id'] = isset($aVals['country_id']) ? $aVals['country_id'] : null;
        $clientData['state_id'] = isset($aVals['state_id']) ? $aVals['state_id'] : null;
        $clientData['city_id'] = isset($aVals['city_id']) ? $aVals['city_id'] : null;
        $clientData['net_worth'] = isset($aVals['net_worth']) ? $aVals['net_worth'] : null;
        $clientData['annual_income'] = isset($aVals['annual_income']) ? $aVals['annual_income'] : null;
        $clientData['emp_status'] = isset($aVals['emp_status']) ? $aVals['emp_status'] : null;
        $clientData['dob'] = isset($aVals['dob']) ? date('y-m-d', strtotime($aVals['dob'])) : null;
        $clientData['address_1'] = isset($aVals['address_1']) ? $aVals['address_1'] : null;
        $clientData['address_2'] = isset($aVals['address_2']) ? $aVals['address_2'] : null;
        $clientData['source_income'] = isset($aVals['source_income']) ? $aVals['source_income'] : null;
        $clientData['invest_known'] = isset($aVals['invest_known']) ? $aVals['invest_known'] : null;
        $clientData['objective_exp'] = isset($aVals['objective_exp']) ? $aVals['objective_exp'] : null;
        $clientData['nationality'] = isset($aVals['nationality']) ? $aVals['nationality'] : null;
        $clientData['previous_exp'] = isset($aVals['previous_exp']) ? $aVals['previous_exp'] : null;
        $clientData['initial_amt'] = isset($aVals['initial_amt']) ? $aVals['initial_amt'] : null;
        $clientData['created_by'] = Auth::user()->id;
        $clientData['updated_by'] = Auth::user()->id;

        $client = Client::where('id', $id)->update($clientData);
        $userData['name'] = $clientData['first_name'] . $clientData['last_name'];
        $userData['email'] = $clientData['email'];
        $userData['dob'] = isset($aVals['dob']) ? date('y-m-d', strtotime($aVals['dob'])) : null;
        $user = User::where('client_id', $id)->update($userData);
        if ($client) {
            $data['activity_type'] = CustomHelper::ACTIVITYLEAD;
            $data['user_id'] = Auth::user()->id;
            $data['activity_msg'] = "Lead" . $clientData['first_name'] . $clientData['last_name'] . "form was updated";
            CustomHelper::activityFeed($data);
            return redirect()->route('leads.index')->with('message', 'Lead Updated Successfully');
        } else {
            return redirect()->route('leads.index')->with('error', 'Failed To Update Lead');
        }
    }

    public function status($id, $status)
    {
        $user = Client::find($id)->update(['status' => $status]);
        return redirect('leads')->with('message', 'Lead status updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aRow = Client::findOrFail($id);
        $aRow->delete();
        return redirect('leads')->with('message', 'Lead deleted Successfully.');
    }

    public function makeClient(Request $request)
    {
        // $status = Client::where('id')
        $aVals = $request->all();
        $clientStatus = Client::where('id', $aVals['id'])->update(["status" => $aVals['status']]);
        if ($clientStatus) {
            if ($aVals['status'] == CustomHelper::KYCAPPROVED) {
                $client = Client::find($aVals['id']);
                $data['activity_type'] = CustomHelper::ACTIVITYLEAD;
                $data['user_id'] = Auth::user()->id;
                $data['activity_msg'] = "Lead" . $client->first_name . $client->last_name . "  KYC was Verified";
                CustomHelper::activityFeed($data);
                // echo "<pre>";
                // print_r($client->first_name);
                // die;
                MailHelper::LeadStatusMail($client, 10);
            }
            $aResponse = [
                "status" => true,
                "data" => $clientStatus,
            ];
            return response()->json($aResponse, 200);
        } else {
            $aResponse = [
                "status" => false,
                "data" => array(),
            ];
            return response()->json($aResponse, 200);
        }
    }

    public function makeClientUser(Request $request)
    {
        $aVals = $request->all();
        // dd($aVals);
        $messages = [
            'first_name.required' => 'Please enter the first name',
            'last_name.required' => 'Please enter the last name',
            'email.required' => 'Please enter the email',
            'password.required' => 'Please enter the password',
            'password_confirmation.required' => 'Please enter the confirm password',
        ];
        $rules = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required_with:password_confirmation|min:8|string|confirmed'],
            'password_confirmation' => 'required',
        ];
        $this->validate($request, $rules, $messages);
        $aVals['name'] = $aVals['first_name'] . $aVals['last_name'];
        $clientData['admin_id'] = Auth::user()->admin_id;
        $clientData['client_id'] = $aVals['lead_id'];
        $clientData['name'] = $aVals['name'];
        $clientData['email'] = isset($aVals['email']) ? $aVals['email'] : null;
        $clientData['password'] = isset($aVals['password']) ? Hash::make($aVals['password']) : null;
        $clientData['dob'] = isset($aVals['dob']) ? date('y-m-d', strtotime($aVals['dob'])) : null;
        $clientData['email_verfied_at'] = Carbon::now();
        $clientData['role_id'] = config('constant.CLIENT_ROLE');
        $clientData['status'] = 1;
        $clientData['created_by'] = Auth::user()->id;
        $clientData['updated_by'] = Auth::user()->id;

        $client = User::create($clientData);

        @$client->syncPermissions($request->permissions);
        if ($client) {
            $data['activity_type'] = CustomHelper::ACTIVITYLEAD;
            $data['user_id'] = Auth::user()->id;
            $data['activity_msg'] = "Lead" . $client->first_name . $client->last_name . "created as user";
            CustomHelper::activityFeed($data);
            $clientData['activity_type'] = CustomHelper::ACTIVITYCLIENT;
            $clientData['user_id'] = Auth::user()->id;
            $clientData['activity_msg'] = "Client" . $client->first_name . $client->last_name . "was created";
            CustomHelper::activityFeed($clientData);
            Client::where('id', $aVals['lead_id'])->update(['status' => CustomHelper::CLIENT]);
            MailHelper::ClientMail($aVals, 6);
            return redirect()->route('leads.index')->with('message', "Client Created Successfully");
        } else {
            return redirect()->route('leads.index')->with('error', "Failed To Create Client");
        }
    }

    public function makeClientUserUpdate(Request $request)
    {
        $aVals = $request->all();
        $messages = [
            'name.required' => 'Please enter the name',
            'email.required' => 'Please enter the email',
        ];
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
        ];
        $this->validate($request, $rules, $messages);
        $clientData['name'] = $aVals['first_name'] . $aVals['last_name'];
        $clientData['email'] = isset($aVals['email']) ? $aVals['email'] : null;
        $clientData['updated_by'] = Auth::user()->id;
        $leadData['first_name'] = $aVals['first_name'];
        $leadData['last_name'] = $aVals['last_name'];
        Client::where('id', $aVals['lead_id'])->update($leadData);
        $client = User::where('email', $aVals['email'])->update($clientData);

        if ($client) {
            return redirect()->route('leads.index')->with('message', "Client Updated Successfully");
        } else {
            return redirect()->route('leads.index')->with('error', "Failed To Update Client");
        }
    }

    public function updateLeadProfile(Request $request, $id)
    {
        $aVals = $request->all();
        // dd($aVals);
        $messages = [
            'first_name.required' => 'Please enter the first name',
            'last_name.required' => 'Please enter the last name',
            'email.required' => 'Please enter the email',
            'contact.required' => 'Please enter the contact number',
            'address_1.required' => 'Please enter full address',

        ];
        $rules = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'contact' => 'required|integer',
            'address_1' => 'required',
        ];
        $this->validate($request, $rules, $messages);
        // if(Auth::user()->role_id == config('constant.ADMIN_ROLE')){
        //     // $clientData['admin_id'] = ;
        // }else{
        //     $aLeads = Client::where('created_by',Auth::user()->id)->get();
        // }
        $clientData['admin_id'] = Auth::user()->admin_id;
        $clientData['first_name'] = isset($aVals['first_name']) ? $aVals['first_name'] : null;
        $clientData['last_name'] = isset($aVals['last_name']) ? $aVals['last_name'] : null;
        $clientData['email'] = isset($aVals['email']) ? $aVals['email'] : null;
        $clientData['contact'] = isset($aVals['contact']) ? $aVals['contact'] : null;
        $clientData['company_name'] = isset($aVals['company_name']) ? $aVals['company_name'] : null;
        $clientData['country'] = isset($aVals['country']) ? $aVals['country'] : null;
        $clientData['country_id'] = isset($aVals['country_id']) ? $aVals['country_id'] : null;
        $clientData['state_id'] = isset($aVals['state_id']) ? $aVals['state_id'] : null;
        $clientData['city_id'] = isset($aVals['city_id']) ? $aVals['city_id'] : null;
        $clientData['net_worth'] = isset($aVals['net_worth']) ? $aVals['net_worth'] : null;
        $clientData['annual_income'] = isset($aVals['annual_income']) ? $aVals['annual_income'] : null;
        $clientData['emp_status'] = isset($aVals['emp_status']) ? $aVals['emp_status'] : null;
        $clientData['dob'] = isset($aVals['dob']) ? date('') : null;
        $clientData['address_1'] = isset($aVals['address_1']) ? $aVals['address_1'] : null;
        $clientData['address_2'] = isset($aVals['address_2']) ? $aVals['address_2'] : null;
        $clientData['source_income'] = isset($aVals['source_income']) ? $aVals['source_income'] : null;
        $clientData['invest_known'] = isset($aVals['invest_known']) ? $aVals['invest_known'] : null;
        $clientData['objective_exp'] = isset($aVals['objective_exp']) ? $aVals['objective_exp'] : null;
        $clientData['nationality'] = isset($aVals['nationality']) ? $aVals['nationality'] : null;
        $clientData['previous_exp'] = isset($aVals['previous_exp']) ? $aVals['previous_exp'] : null;
        $clientData['initial_amt'] = isset($aVals['initial_amt']) ? $aVals['initial_amt'] : null;
        $clientData['status'] = isset($aVals['status']) ? $aVals['status'] : 1;
        $clientData['created_by'] = Auth::user()->id;
        $clientData['updated_by'] = Auth::user()->id;

        $client = Client::where('id', $id)->update($clientData);
        $userData['name'] = $clientData['first_name'] . $clientData['last_name'];
        $userData['email'] = $clientData['email'];
        $userData['dob'] = isset($aVals['dob']) ? date('y-m-d', strtotime($aVals['dob'])) : null;
        $user = User::where('client_id', $id)->update($userData);
        if ($client) {
            $data['activity_type'] = CustomHelper::ACTIVITYLEAD;
            $data['user_id'] = Auth::user()->id;
            $data['activity_msg'] = "Lead" . $clientData['first_name'] . $clientData['last_name'] . "form was updated";
            CustomHelper::activityFeed($data);
            return redirect()->back()->with('message', 'Profile Updated Successfully');
        } else {
            return redirect()->back()->with('error', 'Failed To Update Lead');
        }
    }
}
