<?php

namespace App\Http\Controllers\Tools;

use App\Helpers\MailHelper;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\MessageReply;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admin_message_list|admin_message_create|admin_message_edit|admin_message_destroy', ['only' => ['index', 'show']]);
        $this->middleware('permission:admin_message_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:admin_message_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:admin_message_destroy', ['only' => ['destroy']]);
        $this->middleware('permission:admin_message_status', ['only' => ['status']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role_id == config('constant.ADMIN_ROLE')) {
            $aRows = Message::join('users', 'users.id', '=', 'messages.user_id')->select('users.name', 'messages.*')->groupBy('users.name')->get();
            foreach ($aRows as $key => $aRow) {
                $message = MessageReply::where('message_id', $aRow->id)->orderBy('created_at', "DESC")->first();
                $aRows[$key]['latest_msg'] = $message->message;
            }
        } else {
            $aRows = Message::join('admins', 'admins.id', '=', 'messages.admin_id')->where('user_id', Auth::user()->id)->select('admins.name', 'messages.*')->groupBy('admins.name')->get();
            foreach ($aRows as $key => $aRow) {
                $message = MessageReply::where('message_id', $aRow->id)->orderBy('created_at', "DESC")->first();
                $aRows[$key]['latest_msg'] = $message->message;
            }
        }
        // echo "<pre>";
        // print_r($aRows);
        // die;
        return view('tools.messages.index', compact('aRows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $staff_role = config('constant.ADMIN_STAFF_ROLE');
        $admin_id = Auth::user()->admin_id;
        $aUsers = User::where('admin_id', $admin_id)->where('role_id', $staff_role)->pluck('name', 'id')->toArray();
        $messages = Message::join('users', 'users.id', '=', 'messages.user_id')->select('users.name', 'messages.*')->get();
        $aRow = array();
        return view('tools.messages.add', compact('aUsers', 'messages', 'aRow'));
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
            'user_id.required' => 'Please select the user',
            'message.required' => 'Please enter the message',
        ];
        $rules = [
            'user_id' => 'required|integer',
            'message' => 'required|string',
        ];
        $this->validate($request, $rules, $messages);
        if (Auth::user()->role_id == 2) {
            $mData['type'] = 1;
        } else {
            $mData['type'] = 0;
        }
        $mData['user_id'] = isset($aVals['user_id']) ? $aVals['user_id'] : null;
        $mData['message'] = isset($aVals['message']) ? $aVals['message'] : null;
        if ($request->hasFile('files')) {
            $file = $request->file('files');
            $extension = $file->getClientOriginalExtension();
            $file_name = $file->getClientOriginalName();
            $pro_image = time() . rand(1, 1000) . '.' . $extension;
            $file->move('uploads/ticket/', $file_name);
            $mData['files'] = $file_name;
        }
        $mData['created_by'] = Auth::user()->id;
        $mData['updated_by'] = Auth::user()->id;
        $mData['admin_id'] = Auth::user()->admin_id;
        $mData['status'] = 0;
        $message = Message::create($mData);
        if ($message) {
            $messageReplyData['message_id'] = $message->id;
            $messageReplyData['message'] = isset($aVals['message']) ? $aVals['message'] : null;
            $messageReplyData['reply_by'] = Auth::user()->id;
            $messageReplyData['type'] = 0;
            $messageReply = MessageReply::create($messageReplyData);
            if ($messageReply) {
                $uData = User::findorfail($mData['user_id']);
                $mailData['name'] = $uData->name;
                $mailData['message'] = $aVals['message'];
                $mailData['email'] = $uData->email;
                MailHelper::sendDynamicMail($mailData, 13);
                return redirect()->route('messages.index')->with('message', "Message Send Successfully");
            } else {
                return redirect()->route('messages.index')->with('error', "Failed To Send Message");
            }
        } else {
            return redirect()->route('messages.index')->with('error', "Failed To Send Message");
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
        $message = Message::select('messages.*', 'users.name', 'users.avatar')
            ->join('users', 'users.id', 'messages.created_by')
            ->findOrFail($id);
        $areply = MessageReply::select('message_replies.*', 'users.name', 'users.avatar')
            ->join('users', 'users.id', 'message_replies.reply_by')
            ->where('message_id', $id)
            ->get();

        if (Auth::user()->role_id == config('constant.ADMIN_ROLE')) {
            $aRows = Message::join('users', 'users.id', '=', 'messages.user_id')->select('users.name', 'messages.*')->groupBy('users.name')->get();
            foreach ($aRows as $key => $aRow) {
                $message = MessageReply::where('message_id', $aRow->id)->orderBy('created_at', "DESC")->first();
                $aRows[$key]['latest_msg'] = $message->message;
            }
            $pagename = 'tools.messages.message';
        } else {
            $aRows = Message::join('admins', 'admins.id', '=', 'messages.admin_id')->where('user_id', Auth::user()->id)->select('admins.name', 'messages.*')->groupBy('admins.name')->get();
            foreach ($aRows as $key => $aRow) {
                $message = MessageReply::where('message_id', $aRow->id)->orderBy('created_at', "DESC")->first();
                $aRows[$key]['latest_msg'] = $message->message;
            }
            $pagename = 'tools.messages.staff-message';
        }
        return view($pagename, compact('message', 'areply', 'aRows'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    public function saveadminReply(Request $request)
    {

        $aPosts = $request->all();
        $messages = [
            'message.required' => 'Please enter the message',
        ];
        $rules = [
            'message' => 'required|string',
        ];
        $this->validate($request, $rules, $messages);
        // $aPosts['ticket_id'] = $id;
        $aPosts['type'] = 0;
        $aPosts['reply_by'] = Auth::user()->id;
        // $aPosts['created_at'] = DB::raw('CURRENT_TIMESTAMP');
        // $aPosts['updated_at'] = DB::raw('CURRENT_TIMESTAMP');
        $aUser = MessageReply::create($aPosts);

        return redirect()->back();

    }
    public function saveReply(Request $request)
    {

        $aPosts = $request->all();
        $messages = [
            'message.required' => 'Please enter the message',
        ];
        $rules = [
            'message' => 'required|string',
        ];
        $this->validate($request, $rules, $messages);
        // $aPosts['ticket_id'] = $id;
        $aPosts['type'] = 1;
        $aPosts['reply_by'] = Auth::user()->id;
        // $aPosts['created_at'] = DB::raw('CURRENT_TIMESTAMP');
        // $aPosts['updated_at'] = DB::raw('CURRENT_TIMESTAMP');
        $aUser = MessageReply::create($aPosts);

        return redirect()->back();

    }

    public function searchUser($value)
    {
        $aRow = Message::join('users', 'users.id', 'messages.user_id')->where('users.name', 'LIKE', '%' . $value . '%')->select('users.name', 'messages.*')->groupBy('users.name')->get();
        if ($aRow) {
            $aResponse = [
                "status" => true,
                "data" => $aRow,
            ];
        } else {
            $aResponse = [
                "status" => false,
                "data" => array(),
            ];
        }

        return response()->json($aResponse, 200);
    }
}
