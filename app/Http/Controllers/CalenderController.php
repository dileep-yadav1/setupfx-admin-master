<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalenderController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admin_calendar_list|admin_calendar_event_create|admin_calendar_appointment_create|admin_calendar_event_edit|admin_calendar_appointment_edit|admin_calendar_event_destroy|admin_calendar_appointment_destroy', ['only' => ['index', 'show']]);
        $this->middleware('permission:admin_calendar_event_create', ['only' => ['eventCreate', 'eventStore']]);
        $this->middleware('permission:admin_calendar_appointment_create', ['only' => ['appointmentCreate', 'appointmentStore']]);
        $this->middleware('permission:admin_calendar_event_edit', ['only' => ['eventEdit', 'eventUpdate']]);
        $this->middleware('permission:admin_calendar_appointment_edit', ['only' => ['appointmentEdit', 'appointmentUpdate']]);
        $this->middleware('permission:admin_calendar_event_destroy', ['only' => ['eventDestroy']]);
        $this->middleware('permission:admin_calendar_appointment_destroy', ['only' => ['appointmentDestroy']]);
    }

    public function validator(Request $request, $isEdit = 0)
    {
        $aValids = [
            'title' => ['required', 'string', 'max:255'],
            'venue' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date', 'max:255'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date', 'max:255'],
            'event_color' => ['required', 'string', 'max:255'],
        ];

        if ($isEdit > 0) {
            $this->isEdit = $isEdit;
            $aValids['title'] = ['required', 'string', 'max:255,title,' . $isEdit];
            $aValids['venue'] = ['required', 'string', 'max:255,venue,' . $isEdit];
            $aValids['start_date'] = ['required', 'date', 'max:255,start_date,' . $isEdit];
            $aValids['end_date'] = ['required', 'date', 'after_or_equal:start_date', 'max:255,end_date,' . $isEdit];
            $aValids['event_color'] = ['required', 'string', 'max:255,event_color,' . $isEdit];
        }

        $this->validate($request, $aValids);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $firstday = date('Y-m-d', strtotime("this week"));
        $lastday = date('Y-m-d', strtotime($firstday . " +6 Day"));

        $tasklist = Todo::where('user_id', Auth::user()->id)->where('admin_id', Auth::user()->admin_id)->get();
        // dd($tasklist);
        // dd(Auth::user());
        return view('tools.calendar.index', compact('tasklist'));
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

    public function eventCreate()
    {
        $aRow = array();
        return view('tools.calendar.addEvent', compact('aRow'));
    }

    public function appointmentCreate()
    {
        $aRow = array();
        return view('tools.calendar.addAppointment', compact('aRow'));
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

    public function eventStore(Request $request)
    {
        $aPosts = $request->all();
        $this->validator($request);
        $aUser = $this->savecalendar($request, 1);
        return redirect('calendar')->with('message', 'New Event Added Successfully.');
    }

    public function appointmentStore(Request $request)
    {
        $aPosts = $request->all();
        $this->validator($request);
        $aUser = $this->savecalendar($request, 2);
        return redirect('calendar')->with('message', 'New Appointment Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */

    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        //
    }

    public function eventEdit($id)
    {
        $aRow = Todo::findOrFail($id);
        return view('tools.calendar.addEvent', compact('aRow'));
    }

    public function appointmentEdit($id)
    {
        $aRow = Todo::findOrFail($id);
        return view('tools.calendar.addAppointment', compact('aRow'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        //
    }

    public function eventUpdate(Request $request, $id)
    {
        $aPosts = $request->all();
        $this->validator($request, $id);
        $aUser = $this->savecalendar($request, 1, $id);

        return redirect('calendar')->with('message', 'Event updated Successfully.');
    }

    public function appointmentUpdate(Request $request, $id)
    {
        $aPosts = $request->all();
        $this->validator($request, $id);
        $aUser = $this->savecalendar($request, 2, $id);

        return redirect('calendar')->with('message', 'Appointment updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        //
    }

    public function eventDestroy($id)
    {
        $aRow = Todo::findOrFail($id);
        $aRow->delete();
        return redirect('calendar')->with('message', 'Event deleted Successfully.');
    }

    public function appointmentDestroy($id)
    {
        $aRow = Todo::findOrFail($id);
        $aRow->delete();
        return redirect('calendar')->with('message', 'Event deleted Successfully.');
    }

    private function savecalendar(Request $request, $type = 1, $id = 0)
    {
        $aPosts = $request->all();

        if (isset($id) && $id > 0) {
            $aUser = Todo::find($id);
            $aUser->update($aPosts);
        } else {

            $aPosts['type'] = $type;
            $aPosts['status'] = 1;
            $aPosts['admin_id'] = Auth::user()->admin_id;
            $aPosts['user_id'] = Auth::user()->id;
            $aPosts['ip_address'] = $_SERVER['REMOTE_ADDR'];

            $aUser = Todo::create($aPosts);
        }

        return true;
    }
}
