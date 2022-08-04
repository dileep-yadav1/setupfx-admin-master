<?php

namespace App\Http\Controllers;

use App\Helpers\CustomHelper;
use App\Helpers\MailHelper;
use App\Mail\SendMail;
use App\Models\AdminEmail;
use App\Models\MailVariable;
use App\Models\TabParameter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class EmailController extends Controller
{
    public $email = "";

    public function __construct()
    {
        $this->middleware('permission:admin_email_create', ['only' => ['index', 'show','create','store','edit','update']]);
        $this->emailType = TabParameter::where('param_key','admin_email_type')->pluck('param_name','param_value')->toArray();
        $this->getStatus = CustomHelper::$getStatus;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->all();
        $emailType = $this->emailType;
        $admin_id =  Auth::user()->admin_id;
        $aRows = AdminEmail::where('admin_id',$admin_id)->where('created_by',Auth::user()->id);
        
        if(isset($filter['emailtype'])){
            $aRows = $aRows->where('emailtype', $filter['emailtype']);
        }

        if(isset($filter['subject'])){
            $aRows = $aRows->where('subject', 'LIKE', "%{$filter['subject']}%");
        }
        
        if(isset($filter['tags'])){
            $aRows = $aRows->where('tags', 'LIKE', "%{$filter['tags']}%");
        }
        
        $aRows = $aRows->paginate(20);

        foreach($aRows as $key => $aRow){
            $aRows[$key]['emailtype'] = TabParameter::where('param_value',$aRow->emailtype)->pluck('param_name')->first();
        }
        
        $aRows->appends(['emailtype' => @$filter['emailtype'], 'subject' => @$filter['subject'], 'tags' => @$filter['tags']]);

        return view('email-template.index',compact('aRows', 'emailType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $emailType = $this->emailType;
        $getStatus = $this->getStatus;
        $mailVariable = MailVariable::all();
        $aRow = array();

        return view('email-template.add',compact('emailType','getStatus','aRow','mailVariable'));
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
            'emailtype.required'  => 'Please select the Email Type',
            'subject.required'    => 'Please enter the subject',
            'message.required'    => 'Please enter the message',
        ];
        $rules = [
            'emailtype'  => 'required|integer',
            'subject'     => 'required|string',
            'message'    => 'required|string',
        ];
        $this->validate($request, $rules, $messages);

        $emailData['admin_id']  = Auth::user()->admin_id;
        $emailData['emailtype'] = isset($aVals['emailtype']) ? $aVals['emailtype'] : NULL;
        $emailData['subject'] = isset($aVals['subject']) ? $aVals['subject'] : NULL;
        $emailData['message'] = isset($aVals['message']) ? $aVals['message'] : NULL;
        $emailData['tags'] = isset($aVals['tags']) ? $aVals['tags'] : NULL;
        $emailData['status'] = CustomHelper::ACTIVE;
        $emailData['created_by']  = Auth::user()->id;
        $emailData['updated_by']  = Auth::user()->id;
        $email = AdminEmail::create($emailData);

        if($email){
            return redirect()->route('email.index')->with('message',"Email Created Successfully");
        }else{
            return redirect()->route('email.index')->with('error',"Fail To Create Email");
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
        $emailType = $this->emailType;
        $getStatus = $this->getStatus;
        $mailVariable = MailVariable::all();
        $aRow = AdminEmail::findOrFail($id);

        return view('email-template.add',compact('emailType','getStatus','aRow','mailVariable'));
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
            'emailtype.required'  => 'Please select the Email Type',
            'subject.required'    => 'Please enter the subject',
            'message.required'    => 'Please enter the message',
        ];
        $rules = [
            'emailtype'  => 'required|integer',
            'subject'     => 'required|string',
            'message'    => 'required|string',
        ];
        $this->validate($request, $rules, $messages);

        $emailData['admin_id']  = Auth::user()->admin_id;
        $emailData['emailtype'] = isset($aVals['emailtype']) ? $aVals['emailtype'] : NULL;
        $emailData['subject'] = isset($aVals['subject']) ? $aVals['subject'] : NULL;
        $emailData['message'] = isset($aVals['message']) ? $aVals['message'] : NULL;
        $emailData['tags'] = isset($aVals['tags']) ? $aVals['tags'] : NULL;
        $emailData['status'] = CustomHelper::ACTIVE;
        $emailData['created_by']  = Auth::user()->id;
        $emailData['updated_by']  = Auth::user()->id;
        $email = AdminEmail::where('id',$id)->update($emailData);

        if($email){
            return redirect()->route('email.index')->with('message',"Email Updated Successfully");
        }else{
            return redirect()->route('email.index')->with('error',"Fail To Update Email");
        }
    }

    public function status($id,$status)
    {
        $email = AdminEmail::find($id)->update(['status' => $status]);
        return redirect()->route('email.index')->with('message','Email Status Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aRow = AdminEmail::findOrFail($id);
        $aRow->delete();
        return redirect()->route('email.index')->with('message','Email Deleted Successfully.');
    }

    public function sendTestMail(Request $request){
        $aVals = $request->all();

        $messages = [
            'receivermail.required'  => 'Please enter the Email',
        ];
        $rules = [
            'receivermail'  => 'required|email',
        ];
        $this->validate($request, $rules, $messages);
        $receivermail = isset($aVals['receivermail']) ? $aVals['receivermail'] : NULL;
        // die($receivermail);
        $id = $aVals['id'];
        $template = AdminEmail::find($id);
        $subject = $template->subject;
        $body = $template->message;
        // echo "<pre>";
        // print_r($template_id);
        // die;
        MailHelper::setMailConfig();
        Mail::to($receivermail)->send(new SendMail($subject, $body));

        return redirect()->route('email.index')->with('message','Mail Successfully.');
    }

}
