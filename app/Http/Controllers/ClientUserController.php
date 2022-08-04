<?php

namespace App\Http\Controllers;

use App\Exports\ExportLead;
use App\Helpers\CustomHelper;
use App\Imports\ImportLead;
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
use Maatwebsite\Excel\Facades\Excel;

class ClientUserController extends Controller
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

        $admin_id = Auth::user()->admin_id;
        if (Auth::user()->role_id == config('constant.ADMIN_ROLE')) {
            $user_id = Auth::user()->id;
            $aLeads = Client::join('users', 'users.client_id', '=', 'clients.id')->where('clients.admin_id', $admin_id);
            $today = User::where('admin_id', $admin_id)->whereNotNull('client_id')->where('created_at', Carbon::today())->count();
            $week = User::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('admin_id', $admin_id)->whereNotNull('client_id')->count();
            $month = User::whereMonth('created_at', Carbon::now()->month)->where('admin_id', $admin_id)->whereNotNull('client_id')->count();
        } else {
            $aLeads = Client::join('users', 'users.client_id', '=', 'clients.id')->where('clients.admin_id', $admin_id);
            $today = User::where('created_by', Auth::user()->id)->whereDate('created_at', Carbon::today())->whereNotNull('client_id')->count();
            $week = User::where('created_by', Auth::user()->id)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->whereNotNull('client_id')->count();
            $month = User::where('created_by', Auth::user()->id)->whereMonth('created_at', Carbon::now()->month)->whereNotNull('client_id')->count();
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
        $aLeads = $aLeads->select('clients.*', 'users.id as user_id')->paginate(20);
        $total_leads = count($aLeads);
        $aLeads->appends(["name" => @$filter['name'],"email" => @$filter['email'],"contact" => @$filter['contact'],"country_id" => @$filter['country_id'],"state_id" => @$filter['state_id'],"city_id" => @$filter['city_id'],"nationality" => @$filter['nationality'],"company_name" => @$filter['company_name'],"dob" => @$filter['dob'],"net_worth" => @$filter['net_worth'],"annual_income" => @$filter['annual_income'],"emp_status" => @$filter['emp_status'],"source_income" => @$filter['source_income'],"initial_amt" => @$filter['initial_amt']]);
        $cStatus = $this->clientStatus;
        return view('clients.client-index', compact('aLeads', 'total_leads', 'today', 'week', 'month', 'cStatus', 'aCountry', 'aState', 'aCity', 'aTimezone', 'aSource', 'aStage', 'salesAgent', 'clientStatus', 'incomeData', 'empStatus', 'sourceIncome', 'expStatus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $aRow['user_id'] = User::where('client_id', $aRow->id)->pluck('id')->first();

        return view('clients.client-edit', compact('aCountry', 'aState', 'aCity', 'aTimezone', 'aRow', 'aSource', 'aStage', 'salesAgent', 'clientStatus', 'incomeData', 'empStatus', 'sourceIncome', 'expStatus'));
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
            'source.required' => 'Please select the source',
            'stage_status.required' => 'Please select the Stage',
            'sales_agent.required' => 'Please select the Sales Agent',
        ];
        $rules = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'contact' => 'required|integer',
            'address_1' => 'required',
            'source' => 'required',
            'stage_status' => 'required',
            'sales_agent' => 'required',
        ];
        $this->validate($request, $rules, $messages);
        $clientData['first_name'] = isset($aVals['first_name']) ? $aVals['first_name'] : null;
        $clientData['last_name'] = isset($aVals['last_name']) ? $aVals['last_name'] : null;
        $clientData['email'] = isset($aVals['email']) ? $aVals['email'] : null;
        $clientData['contact'] = isset($aVals['contact']) ? $aVals['contact'] : null;
        $clientData['company_name'] = isset($aVals['company_name']) ? $aVals['company_name'] : null;
        $clientData['source'] = isset($aVals['source']) ? $aVals['source'] : null;
        $clientData['stage_status'] = isset($aVals['stage_status']) ? $aVals['stage_status'] : null;
        $clientData['lead_score'] = isset($aVals['lead_score']) ? $aVals['lead_score'] : null;
        $clientData['lead_value'] = isset($aVals['lead_value']) ? $aVals['lead_value'] : null;
        $clientData['sales_agent'] = isset($aVals['sales_agent']) ? $aVals['sales_agent'] : null;
        $clientData['timezone'] = isset($aVals['timezone']) ? $aVals['timezone'] : null;
        $clientData['tags'] = isset($aVals['tags']) ? json_encode($aVals['tags']) : null;
        $clientData['dob'] = isset($aVals['date_of_birth']) ? $aVals['date_of_birth'] : null;
        $clientData['address_1'] = isset($aVals['address_1']) ? $aVals['address_1'] : null;
        $clientData['address_2'] = isset($aVals['address_2']) ? $aVals['address_2'] : null;
        $clientData['city'] = isset($aVals['city']) ? $aVals['city'] : null;
        $clientData['zipcode'] = isset($aVals['zipcode']) ? $aVals['zipcode'] : null;
        $clientData['state'] = isset($aVals['state']) ? $aVals['state'] : null;
        $clientData['country'] = isset($aVals['country']) ? $aVals['country'] : null;
        $clientData['nationality'] = isset($aVals['nationality']) ? $aVals['nationality'] : null;
        $clientData['register_status'] = isset($aVals['register_status']) ? $aVals['register_status'] : null;

        $client = Client::where('id', $id)->update($clientData);
        $aUsers = User::where('client_id', $id)->first();
        @$aUsers->syncPermissions($request->permissions);
        if ($client) {
            $data['activity_type'] = CustomHelper::ACTIVITYCLIENT;
            $data['user_id'] = Auth::user()->id;
            $data['activity_msg'] = "Client" . $client->first_name . $client->last_name . "  was updated";
            CustomHelper::activityFeed($data);
            return redirect()->route('client.index')->with('message', 'Client Updated Successfully');
        } else {
            return redirect()->route('client.index')->with('error', 'Failed To Update Client');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function importView(Request $request)
    {
        return view('clients.import');
    }

    public function importLeads(Request $request)
    {
        Excel::import(new ImportLead, $request->file('file')->store('files'));
        return redirect()->back();
    }

    public function exportLeads(Request $request)
    {
        return Excel::download(new ExportLead, 'leads.xlsx');
    }
}
