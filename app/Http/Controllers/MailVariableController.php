<?php

namespace App\Http\Controllers;

use App\Models\MailVariable;
use Illuminate\Http\Request;

class MailVariableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->all();
        $aRows = new MailVariable;

        if(isset($filter['variable_key'])){
            $aRows = $aRows->where('variable_key', 'LIKE', "%{$filter['variable_key']}%");    
        }

        if(isset($filter['variable_value'])){
            $aRows = $aRows->where('variable_value', 'LIKE', "%{$filter['variable_value']}%");    
        }

        $aRows = $aRows->paginate(10);

        $aRows->appends(['variable_key' => @$filter['variable_key'], 'variable_value' => @$filter['variable_value']]);

        return view('livewire.mail-variable.list-mail-variable',compact('aRows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $aRow = array();
        return view('livewire.mail-variable.create-mail-variable',compact('aRow'));
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
        // dd($aVals);
        $messages = [
            'variable_key.required'    => 'Please enter the Variable Key',
        ];
        $rules = [
            'variable_key'    => 'required',
        ];
        $this->validate($request, $rules, $messages);
        $vData['variable_key']   = isset($aVals['variable_key']) ? $aVals['variable_key'] : NULL;
        $vData['variable_value'] = isset($aVals['variable_value']) ? $aVals['variable_value'] : NULL;

        $variable = MailVariable::create($vData);
        if($variable){
            return redirect()->route('mail_variables.index')->with('message','Variable Added Successfully');
        }else{
            return redirect()->route('mail_variables.index')->with('error','Failed To Add Variable');
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
        $aRow = MailVariable::find($id);
        return view('livewire.mail-variable.create-mail-variable',compact('aRow'));
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
}
