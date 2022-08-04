<?php

namespace App\Http\Controllers;

use App\Helpers\CustomHelper;
use App\Models\EmailCampaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailCampaignController extends Controller
{
    public function __construct()
    {
        $this->aStatus = CustomHelper::$getStatus;
        $this->middleware('permission:admin_email_campaign_list|admin_email_campaign_create|admin_email_campaign_edit|admin_email_campaign_destroy', ['only' => ['index', 'show']]);
        $this->middleware('permission:admin_email_campaign_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:admin_email_campaign_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:admin_email_campaign_destroy', ['only' => ['destroy']]);
        $this->middleware('permission:admin_email_campaign_status', ['only' => ['status']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->all();
        $aRows = EmailCampaign::where('type',CustomHelper::ADMIN)->where('created_by',Auth::user()->id);

        if(isset($filter['from_name'])){
            $aRows = $aRows->where('from_name', 'LIKE', "%{$filter['from_name']}%"); 
        }

        if(isset($filter['from_email'])){
            $aRows = $aRows->where('from_email', 'LIKE', "%{$filter['from_email']}%"); 
        }

        if(isset($filter['reply_to'])){
            $aRows = $aRows->where('reply_to', 'LIKE', "%{$filter['reply_to']}%"); 
        }

        if(isset($filter['subject'])){
            $aRows = $aRows->where('subject', 'LIKE', "%{$filter['subject']}%"); 
        }

        if(isset($filter['campaign_name'])){
            $aRows = $aRows->where('campaign_name', 'LIKE', "%{$filter['campaign_name']}%"); 
        }

        if(isset($filter['status'])){
            $aRows = $aRows->where('status',$filter['status']); 
        }

        $aRows = $aRows->paginate(10);

        $aRows->appends(['from_name' => @$filter['from_name'], 'from_email' => @$filter['from_email'], 'reply_to' => @$filter['reply_to'], 'subject' => @$filter['subject'], 'campaign_name' => @$filter['campaign_name'], 'status' => @$filter['status']]);
        return view('marketing.email-index',compact('aRows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $aStatus = $this->aStatus;
        $aRow = array();

        return view('marketing.email-add',compact('aStatus','aRow'));
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
        $messages = [
            'from_name.required'  => 'Please enter the From Name',
            'from_email.required' => 'Please enter the From Email',
            'reply_to.required' => 'Please enter the Repy To',
            'campaign_name.required' => 'Please enter the Campaign Name',
            'subject.required'    => 'Please enter the subject',
            'message.required'    => 'Please enter the message',
            'test_emails.required' => 'Please enter the Test Mails'
        ];
        $rules = [
            'from_name'   => 'required',
            'from_email'  => 'required',
            'reply_to'    => 'required',
            'campaign_name'    => 'required',
            'subject'     => 'required|string',
            'message'     => 'required|string',
            'test_emails' => 'required',
        ];
        $this->validate($request, $rules, $messages);

        $ecData['type'] = CustomHelper::ADMIN;
        $ecData['campaign_name'] = isset($aVals['campaign_name']) ? $aVals['campaign_name'] : NULL;
        $ecData['from_name'] = isset($aVals['from_name']) ? $aVals['from_name'] : NULL;
        $ecData['from_email'] = isset($aVals['from_email']) ? $aVals['from_email'] : NULL;
        $ecData['reply_to'] = isset($aVals['reply_to']) ? $aVals['reply_to'] : NULL;
        $ecData['subject'] = isset($aVals['subject']) ? $aVals['subject'] : NULL;
        $ecData['message'] = isset($aVals['message']) ? $aVals['message'] : NULL;
        $ecData['test_emails'] = isset($aVals['test_emails']) ? $aVals['test_emails'] : NULL;
        $ecData['sent_date'] = isset($aVals['sent_date']) ? $aVals['sent_date'] : NULL;
        $ecData['status'] = isset($aVals['status']) ? $aVals['status'] : 1;
        $ecData['created_by'] = Auth::user()->id;
        $ecData['updated_by'] = Auth::user()->id;

        $eCampaign = EmailCampaign::create($ecData);

        if($eCampaign){
            return redirect()->route('email_campaign.index')->with('message','Campaign Created Successfully');
        }else{
            return redirect()->route('email_campaign.index')->with('failed','Failed To Cretae A Campaign');
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
        $aStatus = $this->aStatus;
        $aRow = EmailCampaign::find($id);

        return view('marketing.email-add',compact('aStatus','aRow'));
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
        $messages = [
            'from_name.required'  => 'Please enter the From Name',
            'from_email.required' => 'Please enter the From Email',
            'reply_to.required' => 'Please enter the Repy To',
            'campaign_name.required' => 'Please enter the Campaign Name',
            'subject.required'    => 'Please enter the subject',
            'message.required'    => 'Please enter the message',
            'test_emails.required' => 'Please enter the Test Mails'
        ];
        $rules = [
            'from_name'   => 'required',
            'from_email'  => 'required',
            'reply_to'    => 'required',
            'campaign_name'    => 'required',
            'subject'     => 'required|string',
            'message'     => 'required|string',
            'test_emails' => 'required',
        ];
        $this->validate($request, $rules, $messages);

        $ecData['type'] = CustomHelper::ADMIN;
        $ecData['campaign_name'] = isset($aVals['campaign_name']) ? $aVals['campaign_name'] : NULL;
        $ecData['from_name'] = isset($aVals['from_name']) ? $aVals['from_name'] : NULL;
        $ecData['from_email'] = isset($aVals['from_email']) ? $aVals['from_email'] : NULL;
        $ecData['reply_to'] = isset($aVals['reply_to']) ? $aVals['reply_to'] : NULL;
        $ecData['subject'] = isset($aVals['subject']) ? $aVals['subject'] : NULL;
        $ecData['message'] = isset($aVals['message']) ? $aVals['message'] : NULL;
        $ecData['test_emails'] = isset($aVals['test_emails']) ? $aVals['test_emails'] : NULL;
        $ecData['sent_date'] = isset($aVals['sent_date']) ? $aVals['sent_date'] : NULL;
        $ecData['status'] = isset($aVals['status']) ? $aVals['status'] : 1;
        $ecData['created_by'] = Auth::user()->id;
        $ecData['updated_by'] = Auth::user()->id;

        $eCampaign = EmailCampaign::where('id',$id)->update($ecData);

        if($eCampaign){
            return redirect()->route('email_campaign.index')->with('message','Campaign Updated Successfully');
        }else{
            return redirect()->route('email_campaign.index')->with('failed','Failed To Update A Campaign');
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
        $aRow = EmailCampaign::findOrFail($id);
        $aRow->delete();
        return redirect()->route('email_campaign.index')->with('message','Campaign Deleted Successfully.');
    }

    public function status($id,$status)
    {
        $email = EmailCampaign::find($id)->update(['status' => $status]);
        return redirect()->route('email_campaign.index')->with('message','Campaign Status Updated Successfully.');
    }
}
