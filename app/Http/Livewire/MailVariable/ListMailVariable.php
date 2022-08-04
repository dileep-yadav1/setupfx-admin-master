<?php

namespace App\Http\Livewire\MailVariable;

use App\Models\MailVariable;
use Illuminate\Http\Request;
use Livewire\Component;

class ListMailVariable extends Component
{
    public function index()
    {
        $aRows = MailVariable::all();
        return view('livewire.mail-variable.list-mail-variable',compact('aRows'));
    }
    public function create(){
        return view('livewire.mail-variable.create-mail-variable');
    }

    public function store(Request $request){

    }
}
