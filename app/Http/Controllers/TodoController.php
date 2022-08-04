<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admin_todo_list|admin_todo_create|admin_todo_edit|admin_todo_destroy', ['only' => ['index', 'show']]);
        $this->middleware('permission:admin_todo_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:admin_todo_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:admin_todo_destroy', ['only' => ['destroy']]);
    }

    protected function validator(Request $request, $isEdit = 0)
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

        $today_list = Todo::where('user_id', Auth::user()->id)->where('type', 1)->whereDate('start_date', date("Y-m-d"))->get();

        $ids = [];
        if ($today_list) {
            foreach ($today_list as $value) {
                $ids[] = $value->id;
            }
        }

        $tomorrow_list = Todo::where('user_id', Auth::user()->id)->where('type', 1)->whereDate('start_date', date("Y-m-d", strtotime("+1 Day")))->get();

        $week_list = Todo::where('user_id', Auth::user()->id)->where('type', 1)->whereBetween('start_date', [$firstday, $lastday])->whereNotIn('id', $ids)->get();

        return view('tools.todo.index', compact('today_list', 'tomorrow_list', 'week_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $aRow = array();
        return view('tools.todo.add', compact('aRow'));
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
        $aUser = $this->savetodo($request);
        return redirect('todo')->with('message', 'New Event Added Successfully.');
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
        $aRow = Todo::findOrFail($id);
        return view('tools.todo.add', compact('aRow'));
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
        $aUser = $this->savetodo($request, $id);

        return redirect('todo')->with('message', 'Event updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aRow = Todo::findOrFail($id);
        $aRow->delete();
        return redirect('todo')->with('message', 'Event deleted Successfully.');
    }

    public function savetodo(Request $request, $id = 0)
    {
        $aPosts = $request->all();

        if (isset($id) && $id > 0) {
            $aUser = Todo::find($id);
            $aUser->update($aPosts);
        } else {

            $aPosts['type'] = 1;
            $aPosts['status'] = 1;
            $aPosts['admin_id'] = Auth::user()->admin_id;
            $aPosts['user_id'] = Auth::user()->id;
            $aPosts['ip_address'] = $_SERVER['REMOTE_ADDR'];

            $aUser = Todo::create($aPosts);
        }

        return true;
    }
}
