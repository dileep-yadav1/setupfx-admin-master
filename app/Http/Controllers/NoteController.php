<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admin_note_list|admin_note_create|admin_note_edit|admin_note_destroy', ['only' => ['index', 'show']]);
        $this->middleware('permission:admin_note_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:admin_note_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:admin_note_destroy', ['only' => ['destroy']]);
    }

    protected function validator(Request $request, $isEdit = 0)
    {
        $aValids = [
            'title' => ['required', 'string', 'max:255'],
            'desc' => ['required', 'string'],
        ];

        $this->validate($request, $aValids);
    }
    /**
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aRows = Note::all()->where('user_id', Auth::user()->id);
        $aRow = [];
        return view('tools.notes.index', compact('aRows', 'aRow'));
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
        $aPosts = $request->all();
        $this->validator($request);
        $aUser = $this->saveNote($request);
        return redirect('note')->with('message', 'New Note Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aRows = Note::all()->where('user_id', Auth::user()->id);
        $aRow = Note::findOrFail($id);
        return view('tools.notes.index', compact('aRows', 'aRow'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $aPosts = $request->all();
        $this->validator($request, $id);
        $aUser = $this->saveNote($request, $id);

        return redirect('note')->with('message', 'Note updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aRow = Note::findOrFail($id);
        $aRow->delete();
        return redirect('note')->with('message', 'Note deleted Successfully.');
    }

    private function saveNote(Request $request, $id = 0)
    {
        $aPosts = $request->all();

        if (isset($id) && $id > 0) {
            $aUser = Note::find($id);
            $aUser->update($aPosts);
        } else {
            $aPosts['user_id'] = Auth::user()->id;
            $aUser = Note::create($aPosts);
        }

        return true;
    }
}
