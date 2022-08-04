<?php

namespace App\Http\Controllers\Client;

use App\Helpers\CustomHelper;
use App\Helpers\MailHelper;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\AdminEmail;
use App\Models\Client;
use App\Models\ClientDocument;
use App\Models\Comment;
use App\Models\CommentReply;
use App\Models\Contact;
use App\Models\LeadEmail;
use App\Models\MailVariable;
use App\Models\Message;
use App\Models\TabParameter;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientViewController extends Controller
{
    public function __construct()
    {
        $this->emailType = TabParameter::where('param_key', 'admin_email_type')->pluck('param_name', 'param_value')->toArray();
    }

    public function clientShow(Request $request)
    {
        $aVals = $request->all();
        // echo "<pre>";
        // print_r($aVals);
        // die;
        $ticket = array();
        $message = array();
        $activity = array();
        $account = array();
        $areply = array();
        $emailType = array();
        $mailVariable = array();
        $email_type = "";
        $contact = array();
        $mailVariable = array();
        $message = "";
        $eKyc = array();
        $docType = array();
        $comment = array();
        $tasklist = array();
        $id = $request->id;
        $viewName = $request->key;
        // echo $viewName;
        // // echo $request->type;
        // echo $id;die;
        $settingId = CustomHelper::getStaffViewId($request->key);
        if ($settingId == 0) {
            return redirect()->back()->with('error', 'Invalid Attempt');
        }
        $admin_id = Auth::user()->admin_id;
        // $aRow
        $aRow = Client::where('id', $request->id)->first();
        $user = User::where('client_id', $request->id)->first();

        if ($viewName == "Overview") {
            if ($user) {
                $activity = Activity::where('user_id', $user->id)->where('created_by', Auth::user()->id)->get();
                $account = Activity::where('user_id', $user->id)->where('activity_type', 4)->where('created_by', Auth::user()->id)->get();
            }
            $comment = Comment::join('clients', 'clients.id', '=', 'comments.client_id')->where('comments.client_id', $request->id)->select('clients.first_name', 'comments.id')->orderBy('comments.created_at', 'DESC')->first();
            if ($comment) {
                $areply = CommentReply::select('comment_replies.*', 'users.name', 'users.avatar')
                    ->join('users', 'users.id', 'comment_replies.reply_by')
                    ->where('comment_id', $comment->id)
                    ->get();
            }
        }

        if ($viewName == "Calls") {
            $icon = "fas fa-phone-alt";
        }
        if ($viewName == "Emails") {
            $emailType = $this->emailType;
            $contact = Contact::where('id', $request->id)->first();
            $mailVariable = MailVariable::all();
            $email_type = $request->type;
            if (isset($request->type)) {
                $message = AdminEmail::where('emailtype', $request->type)->pluck('message')->first();
            }
        }
        if ($viewName == "Activity") {
            $icon = "fas fa-history";
        }
        if ($viewName == "EKYC") {
            $eKyc = ClientDocument::where('client_id', $id)->where('admin_id', Auth::user()->admin_id)->get();
            $type_array = array();
            foreach ($eKyc as $kyc) {
                $type_array[] = $kyc->doc_type;
            }
            $docType = TabParameter::whereNotIn('param_value', $type_array)->where('param_key', 'admin_doc_type')->pluck('param_name', 'param_value')->toArray();
        }
        if ($viewName == "Comments") {
            $comment = Comment::join('clients', 'clients.id', '=', 'comments.client_id')->where('comments.client_id', $request->id)->select('clients.first_name', 'comments.id')->orderBy('comments.created_at', 'DESC')->first();
            if ($comment) {
                $areply = CommentReply::select('comment_replies.*', 'users.name', 'users.avatar')
                    ->join('users', 'users.id', 'comment_replies.reply_by')
                    ->where('comment_id', $comment->id)
                    ->get();
            }
        }
        if ($viewName == "Calender") {
            $tasklist = Todo::where('user_id', Auth::user()->id)->where('admin_id', Auth::user()->admin_id)->get();
        }
        if ($viewName == "Whatsapp") {
            $icon = "fab fa-whatsapp";
        }

        if ($viewName == "SMS") {
            $message = Message::join('users', 'users.id', '=', 'messages.user_id')->join('message_replies', 'message_replies.message_id', '=', 'messages.id')->where('messages.user_id', $id)->select('users.name', 'message_replies.*')->orderBy('message_replies.created_at', 'DESC')->get();
            foreach ($message as $key => $msg) {
                $message[$key]['reply_by'] = User::where('id', $msg->reply_by)->pluck('name')->first();
            }
        }
        // echo "<pre>";
        // print_r($areply);
        // die;
        return view('clients.' . $viewName, compact('aRow', 'tasklist', 'viewName', 'settingId', 'id', 'ticket', 'message', 'activity', 'account', 'user', 'areply', 'emailType', 'mailVariable', 'contact', 'email_type', 'eKyc', 'docType', 'comment'));
    }
    public function leadSendMail(Request $request)
    {
        $aVals = $request->all();
        // echo "<pre>";
        // print_r($aVals);
        // die;
        $leadMail["lead_id"] = isset($aVals["lead_id"]) ? $aVals["lead_id"] : null;
        $leadMail["emailtype"] = isset($aVals["emailtype"]) ? $aVals["emailtype"] : null;
        $leadMail["subject"] = isset($aVals["subject"]) ? $aVals["subject"] : null;
        $leadMail["message"] = isset($aVals["message"]) ? $aVals["message"] : null;
        if ($request->hasFile('mail_file')) {
            $imageext = $request->file('mail_file')->getClientOriginalExtension();
            // echo $imageext;die;
            $leadMail["mail_file"] = CustomHelper::uploadImage($request->file('mail_file'), true, 'uploads/admin_doc/', $imageext);
        }

        $leadMail["sent_date"] = isset($aVals["sent_date"]) ? $aVals["sent_date"] : date('Y-m-d');
        $leadMail["created_by"] = Auth::user()->id;
        $leadMail["updated_by"] = Auth::user()->id;

        $today = date('Y-m-d');
        if ($today == $leadMail['sent_date']) {
            $leadMail['status'] = 1;
        } else {
            $leadMail['status'] = 2;
        }
        // echo "<pre>";
        // print_r($leadMail);
        // die;
        $lMail = LeadEmail::create($leadMail);
        if ($lMail) {
            $data = Client::where('id', $aVals['lead_id'])->select('first_name as name', 'email')->first();
            if (!$leadMail['emailtype']) {
                $data['message'] = $aVals['message'];
                $data['subject'] = $aVals['subject'];
            }
            MailHelper::sendDynamicMail($data, $leadMail["emailtype"]);
            return redirect()->back()->with('message', 'Mail Sent Successfully');
        } else {
            return redirect()->back()->with('error', 'Failed To Sent Mail');
        }
    }

    public function uploadLeadFiles(Request $request)
    {
        $aVals = $request->all();
        // echo "<pre>";
        // print_r($aVals);
        // die;
        $messages = [
            'doc_type.required' => 'Please select the document type',
        ];
        $rules = [
            'doc_type' => 'required',
        ];
        $this->validate($request, $rules, $messages);
        if ((!$request->hasFile('front_side')) && (!$request->hasFile('back_side'))) {
            return back()->with('error', 'Please upload atleast one file');
        }
        $leadDoc['admmin_id'] = Auth::user()->admin_id;
        $leadDoc['client_id'] = isset($aVals['client_id']) ? $aVals['client_id'] : null;
        if ($request->hasFile('front_side')) {
            $imageext = $request->file('front_side')->getClientOriginalExtension();
            // echo $imageext;die;
            $leadDoc['front_side'] = CustomHelper::uploadImage($request->file('front_side'), true, 'uploads/admin_doc/', $imageext);
        }
        if ($request->hasFile('back_side')) {
            $imageext = $request->file('back_side')->getClientOriginalExtension();
            // echo $imageext;die;
            $leadDoc['back_side'] = CustomHelper::uploadImage($request->file('back_side'), true, 'uploads/admin_doc/', $imageext);
        }
        $leadDoc['description'] = isset($aVals['description']) ? $aVals['description'] : null;
        $leadDoc['doc_type'] = isset($aVals['doc_type']) ? $aVals['doc_type'] : null;
        $leadDoc["status"] = 1;
        $leadDoc["created_by"] = Auth::user()->id;
        $leadDoc["updated_by"] = Auth::user()->id;
        // echo "<pre>";
        // print_r($leadDoc);
        // die;
        $leadDocumnet = ClientDocument::create($leadDoc);
        if ($leadDocumnet) {
            $user = User::findorfail($aVals['client_id']);
            $doc_name = CustomHelper::getLeadDocumentType($leadDoc['doc_type']);
            $data['activity_type'] = CustomHelper::ACTIVITYDOCUMENT;
            $data['user_id'] = Auth::user()->id;
            $data['activity_msg'] = "Lead" . $user->name . $doc_name . "document was uploaded";
            $data['type'] = 0;
            $data['admin_id'] = Auth::user()->admin_id;
            $data['created_by'] = Auth::user()->id;
            $data['updated_by'] = Auth::user()->id;
            Activity::create($data);
            return redirect()->back()->with('message', 'Document Uploaded Successfully');
        } else {
            return redirect()->back()->with('error', 'Failed To Upload Document');
        }
    }

    public function deleteUploadDoc($id)
    {
        $document = ClientDocument::where('id', $id)->first();
        // $client = Client::findorfail($document->client_id);
        $doc_name = CustomHelper::getLeadDocumentType($document->doc_type);
        $user = User::findorfail($document->client_id);
        $data['activity_type'] = CustomHelper::ACTIVITYDOCUMENT;
        $data['user_id'] = $user->id;
        $data['activity_msg'] = "Lead" . $user->name . $doc_name . "document was deleted";
        $data['type'] = 0;
        $data['admin_id'] = Auth::user()->admin_id;
        $data['created_by'] = Auth::user()->id;
        $data['updated_by'] = Auth::user()->id;
        Activity::create($data);
        $document->delete();

        return redirect()->back()->with('message', "Document Deleted Successfully");
    }

    public function sendVerificationMail($id)
    {
        $client = Client::findorfail($id);
        $user = User::where('client_id', $id)->first()->toArray();
        // echo "<pre>";
        // print_r($user);
        // die;
        $data['activity_type'] = CustomHelper::ACTIVITYACCOUNT;
        $data['user_id'] = $user['id'];
        $data['activity_msg'] = "Lead" . $user['name'] . "Email Verification mail sent successfully";
        $data['type'] = 0;
        $data['admin_id'] = Auth::user()->admin_id;
        $data['created_by'] = Auth::user()->id;
        $data['updated_by'] = Auth::user()->id;
        MailHelper::sendDynamicMail($user, 14);
        return redirect()->back()->with('message', 'Mail Sent Successfully');
    }

    public function sendDocumentMail($id)
    {
        $client = Client::findorfail($id);
        $user = User::where('client_id', $id)->first()->toArray();
        // echo "<pre>";
        // print_r($user);
        // die;
        $data['activity_type'] = CustomHelper::ACTIVITYACCOUNT;
        $data['user_id'] = $user['id'];
        $data['activity_msg'] = "Lead" . $user['name'] . "Document Remainder mail sent successfully";
        $data['type'] = 0;
        $data['admin_id'] = Auth::user()->admin_id;
        $data['created_by'] = Auth::user()->id;
        $data['updated_by'] = Auth::user()->id;
        MailHelper::sendDynamicMail($user, 15);
        return redirect()->back()->with('message', 'Mail Sent Successfully');
    }

    public function saveclientReply(Request $request)
    {
        $comment = Comment::where('client_id', $request->client_id)->first();
        if ($comment) {
            $aPosts = $request->all();
            $messages = [
                'message.required' => 'Please enter the message',
            ];
            $rules = [
                'message' => 'required|string',
            ];
            $this->validate($request, $rules, $messages);
            $aPosts['comment_id'] = $comment->id;
            $aPosts['type'] = 1;
            $aPosts['reply_by'] = Auth::user()->id;
            // $aPosts['created_at'] = DB::raw('CURRENT_TIMESTAMP');
            // $aPosts['updated_at'] = DB::raw('CURRENT_TIMESTAMP');
            $aUser = CommentReply::create($aPosts);
            if ($aUser) {
                return redirect()->back()->with('message', 'Comment Sent Successfully');
            } else {
                return redirect()->back()->with('error', 'Failed To Sent Comment');
            }
        } else {
            if (Auth::user()->role_id == 2) {
                $cData['type'] = 1;
            } else {
                $cData['type'] = 0;
            }
            $cData['client_id'] = isset($aPosts['client_id']) ? $aPosts['client_id'] : null;
            $cData['created_by'] = Auth::user()->id;
            $cData['updated_by'] = Auth::user()->id;
            $cData['admin_id'] = Auth::user()->admin_id;
            $cData['status'] = 0;
            $comment = Comment::create($cData);
            if ($comment) {
                $messageReplyData['comment_id'] = $comment->id;
                $messageReplyData['message'] = isset($aPosts['message']) ? $aPosts['message'] : null;
                $messageReplyData['reply_by'] = Auth::user()->id;
                $messageReplyData['type'] = 0;
                $messageReply = CommentReply::create($messageReplyData);
                return redirect()->back()->with('message', 'Comment Sent Successfully');
            } else {
                return redirect()->back()->with('error', 'Failed To Sent Comment');
            }
        }

    }
}
