<?php

namespace App\Http\Controllers\Client;

use App\Helpers\CustomHelper;
use App\Helpers\MailHelper;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Ticket;
use App\Models\TicketReply;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientTicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:client_ticket_list|client_ticket_create|client_ticket_edit|client_ticket_delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:client_ticket_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:client_ticket_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:client_ticket_delete', ['only' => ['destroy']]);
        $this->middleware('permission:client_ticket_status', ['only' => ['status']]);
        $this->middleware('permission:client_ticket_reply', ['only' => ['reply', 'saveReply']]);
        $this->aDepartment = CustomHelper::getdepartmentList();
        $this->aPriority = CustomHelper::$getPriorityType;
        $this->getSalesAgent = Client::$getSalesAgent;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->all();
        
        $aDepartment = CustomHelper::getdepartmentList();
        $aPriority = $this->aPriority;
        $getSalesAgent = $this->getSalesAgent;

        $admin_role = config('constant.STAFF_ROLE');
        if (Auth::user()->role_id == config('constant.ADMIN_ROLE')) {
            $aTickets = Ticket::where('type', 0);
        } else {
            $aTickets = Ticket::where('type', 0)->where('created_by', Auth::user()->id);
        }

        if(isset($filter['department'])){
            $aTickets = $aTickets->where('department', $filter['department']);
        }

        if(isset($filter['subject'])){
            $aTickets = $aTickets->where('subject', 'LIKE', "%{$filter['subject']}%");
        }


        if(isset($filter['reporter'])){
            $aTickets = $aTickets->where('reporter', $filter['reporter']);
        }


        if(isset($filter['priority'])){
            $aTickets = $aTickets->where('priority', $filter['priority']);
        }

        if(isset($filter['tags'])){
            $aTickets = $aTickets->where('tags', 'LIKE', "%{$filter['tags']}%");
        }

        if(isset($filter['status'])){
            $aTickets = $aTickets->where('status', $filter['status']);
        }

        $aTickets = $aTickets->paginate(20);

        $aTickets->appends(['department' => @$filter['department'], 'subject' => @$filter['subject'], 'reporter' => @$filter['reporter'], 'priority' => @$filter['priority'], 'tags' => @$filter['tags'], 'status' => @$filter['status']]);

        return view('clientTicket.index',compact('aTickets', 'aDepartment', 'aPriority', 'getSalesAgent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $aDepartment = $this->aDepartment;
        $aPriority = $this->aPriority;
        $getSalesAgent = $this->getSalesAgent;
        $aRow = array();

        return view('clientTicket.add', compact('aDepartment', 'aPriority', 'aRow', 'getSalesAgent'));
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
            'department.required' => 'Please select the department',
            'subject.required' => 'Please enter the last name',
            'reporter.required' => 'Please enter the email',
            'priority.required' => 'Please enter the contact number',
            'message.required' => 'Please enter full address',
        ];
        $rules = [
            'department' => 'required|integer',
            'subject' => 'required|string',
            'reporter' => 'required|integer',
            'priority' => 'required|integer',
            'message' => 'required|string',
        ];
        $this->validate($request, $rules, $messages);

        if (Auth::user()->role_id == config('constant.ADMIN_ROLE')) {
            $ticketData['type'] = 1;
        } else {
            $ticketData['type'] = 0;
        }
        $aVals['name'] = Auth::user()->name;
        $ticketData['department'] = isset($aVals['department']) ? $aVals['department'] : null;
        $ticketData['subject'] = isset($aVals['subject']) ? $aVals['subject'] : null;
        $ticketData['reporter'] = isset($aVals['reporter']) ? $aVals['reporter'] : null;
        $ticketData['priority'] = isset($aVals['priority']) ? $aVals['priority'] : null;
        $ticketData['tags'] = isset($aVals['tags']) ? json_encode($aVals['tags']) : null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $file_name = $file->getClientOriginalName();
            $pro_image = time() . rand(1, 1000) . '.' . $extension;
            $file->move('uploads/ticket/', $file_name);
            $ticketData['file'] = $file_name;
        }
        $ticketData['created_by'] = Auth::user()->id;
        $ticketData['updated_by'] = Auth::user()->id;
        $ticketData['admin_id'] = Auth::user()->admin_id;
        $ticketData['status'] = 0;
        // dd($ticketData);
        $ticket = Ticket::create($ticketData);
        if ($ticket) {
            $data['activity_type'] = CustomHelper::ACTIVITYACCOUNT;
            $data['user_id'] = Auth::user()->id;
            $data['activity_msg'] = "Ticket was generated by" . Auth::user()->name;
            $ticketReplyData['ticket_id'] = $ticket->id;
            $ticketReplyData['message'] = isset($aVals['message']) ? $aVals['message'] : null;
            $ticketReplyData['reply_by'] = Auth::user()->id;
            $ticketReplyData['type'] = 0;
            $ticketReply = TicketReply::create($ticketReplyData);
            if ($ticketReply) {
                MailHelper::ClientTicket($aVals, 9);
                return redirect()->route('client-ticket.index')->with('message', "Ticket Created Successfully");
            } else {
                return redirect()->route('client-ticket.index')->with('error', "Failed To Create Ticket");
            }
        } else {
            return redirect()->route('client-ticket.index')->with('error', "Failed To Create Ticket");
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

    public function reply($id)
    {
        $aRow = Ticket::select('tickets.*', 'admins.name as c_name', 'users.name as u_name')
            ->join('admins', 'admins.id', 'tickets.admin_id')
            ->join('users', 'users.id', 'tickets.created_by')
            ->findOrFail($id);
        if ($aRow['tags'] != null) {
            $aRow['tags'] = trim($aRow['tags'], '"');
        }
        // echo "<pre>";
        // print_r($aRow);
        // die;
        $areply = TicketReply::select('ticket_replies.*', 'users.name')
            ->join('users', 'users.id', 'ticket_replies.reply_by')
            ->where('ticket_id', $id)
            ->get();
        // echo "===================================";
        // echo "<pre>";
        // print_r($areply);
        // die;
        return view('clientTicket.chat', compact('aRow', 'areply'));
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
        $aPosts['type'] = 0;
        $aPosts['reply_by'] = Auth::user()->id;
        // $aPosts['created_at'] = DB::raw('CURRENT_TIMESTAMP');
        // $aPosts['updated_at'] = DB::raw('CURRENT_TIMESTAMP');
        $aUser = TicketReply::create($aPosts);

        return redirect()->back();

    }
    public function adminReply($id)
    {
        $aRow = Ticket::select('tickets.*', 'admins.name as c_name', 'users.name as u_name')
            ->join('admins', 'admins.id', 'tickets.admin_id')
            ->join('users', 'users.id', 'tickets.created_by')
            ->findOrFail($id);
        if ($aRow['tags'] != null) {
            $aRow['tags'] = trim($aRow['tags'], '"');
        }
        // echo "<pre>";
        // print_r($aRow);
        // die;
        $areply = TicketReply::select('ticket_replies.*', 'users.name')
            ->join('users', 'users.id', 'ticket_replies.reply_by')
            ->where('ticket_id', $id)
            ->get();
        // echo "===================================";
        // echo "<pre>";
        // print_r($areply);
        // die;
        return view('clientTicket.admin-chat', compact('aRow', 'areply'));
    }

    public function adminsaveReply(Request $request)
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
        $aUser = TicketReply::create($aPosts);

        return redirect()->back();

    }

    public function ticketStatus($id, $status)
    {
        $ticket = Ticket::find($id)->update(['status' => $status]);
        $ticketData = Ticket::find($id);
        $ticketUser = User::where('id', $ticketData->created_by)->first();
        if ($status == 1) {
            MailHelper::ClientTicketStatus($ticketUser, 11);
        }
        return redirect('client-ticket')->with('message', 'Ticket Status Updated Successfully');
    }
}
