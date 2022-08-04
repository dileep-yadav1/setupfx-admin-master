<?php

namespace App\Http\Controllers\Marketing;

use App\Helpers\CustomHelper;
use App\Helpers\MailHelper;
use App\Http\Controllers\Controller;
use App\Models\AdminEmail;
use App\Models\Contact;
use App\Models\ContactEmail;
use App\Models\MailVariable;
use App\Models\TabParameter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactMarketingController extends Controller
{
    public function __construct()
    {
        $this->emailType = TabParameter::where('param_key', 'admin_email_type')->pluck('param_name', 'param_value')->toArray();
        // $this->salesAgent = CustomHelper::getsalesagents();
    }
    public function index(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // die;
        $id = $request->id;
        $marketingName = $request->key;
        $email_type = $request->type;
        // echo $marketingName;die;
        $settingId = CustomHelper::getContactMarketingId($request->key);
        if ($settingId == 0) {
            return redirect()->back()->with('error', 'Invalid Attempt');
        }
        $admin_id = Auth::user()->admin_id;
        $aRow = Contact::where('id', $request->id)->first();
        $emailType = $this->emailType;
        $mailVariable = MailVariable::all();
        $message = "";
        if (isset($request->type)) {
            $message = AdminEmail::where('emailtype', $request->type)->pluck('message')->first();
        }
        // echo "<pre>";
        // print_r($message);
        // die;
        // $salesAgent = $this->salesAgent;

        return view('contacts.' . $marketingName, compact('aRow', 'email_type', 'marketingName', 'settingId', 'emailType', 'mailVariable', 'message', 'id'));
    }

    public function getTemplate(Request $request)
    {
        $aVals = $request->all();
        $email_type = isset($aVals['email_type']) ? $aVals['email_type'] : null;

        $aRow = AdminEmail::where('emailtype', $email_type)->pluck('message')->first();

        $aResponse = [
            "status" => true,
            "data" => $aRow,
        ];

        return response()->json($aResponse, 200);

    }

    public function conversationStore(Request $request)
    {
        $aVals = $request->all();
        $cEMail["contact_id"] = isset($aVals["contact_id"]) ? $aVals["contact_id"] : null;
        $cEMail["emailtype"] = isset($aVals["emailtype"]) ? $aVals["emailtype"] : null;
        $cEMail["subject"] = isset($aVals["subject"]) ? $aVals["subject"] : null;
        $cEMail["message"] = isset($aVals["message"]) ? $aVals["message"] : null;
        $cEMail["mail_file"] = isset($aVals["mail_file"]) ? $aVals["mail_file"] : null;
        $cEMail["sent_date"] = isset($aVals["sent_date"]) ? $aVals["sent_date"] : date('Y-m-d');
        $cEMail["status"] = isset($aVals["status"]) ? $aVals["status"] : null;
        $cEMail["created_by"] = Auth::user()->id;
        $cEMail["updated_by"] = Auth::user()->id;
        $contactEmail = ContactEmail::create($cEMail);

        if ($contactEmail) {
            $today = date('Y-m-d');
            // $data['user_id'] =
            if ($cEMail['sent_date'] == $today) {
                $data = Contact::where('id', $aVals['contact_id'])->select('full_name as name', 'email')->first();
                if (!$cEMail['emailtype']) {
                    $data['message'] = $aVals['message'];
                    $data['subject'] = $aVals['subject'];
                }
                MailHelper::sendDynamicMail($data, $cEMail["emailtype"]);
            }
            // die;
            return redirect()->route('contact.index')->with('message', 'Mail Sent Successfully');
        } else {
            return redirect()->route('contact.index')->with('error', 'Failed To Sent Mail');
        }
    }
}
