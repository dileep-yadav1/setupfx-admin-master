<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admin_contact_list|admin_contact_create|admin_contact_edit|admin_contact_destroy', ['only' => ['index', 'show']]);
        $this->middleware('permission:admin_contact_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:admin_contact_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:admin_contact_destroy', ['only' => ['destroy']]);
        $this->middleware('permission:admin_contact_status', ['only' => ['status']]);
    }

    protected function validator(Request $request, $isEdit = 0)
    {
        $aValids = [
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:contacts'],
            'company_name' => ['required', 'string', 'max:255'],
            'company_email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'tags' => ['required', 'string', 'max:255'],
        ];

        if ($isEdit > 0) {
            $this->isEdit = $isEdit;
            $aValids['full_name'] = ['required', 'string', 'max:255,full_name,' . $isEdit];
            $aValids['email'] = ['required', 'string', 'email', 'max:255', 'unique:contacts,email,' . $isEdit];
            $aValids['company_name'] = ['required', 'string', 'max:255,company_name,' . $isEdit];
            $aValids['company_email'] = ['required', 'string', 'email', 'max:255,company_email,' . $isEdit];
            $aValids['phone'] = ['required', 'string', 'max:255,phone,' . $isEdit];
            $aValids['tags'] = ['required', 'string', 'max:255,tags,' . $isEdit];
        }

        $this->validate($request, $aValids);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->all();
        $aUsers = Contact::where('admin_id', Auth::user()->admin_id);

        if(isset($filter['full_name'])){
            $aUsers = $aUsers->where('full_name', 'LIKE', "%{$filter['full_name']}%"); 
        }

        if(isset($filter['company_name'])){
            $aUsers = $aUsers->where('company_name', 'LIKE', "%{$filter['company_name']}%"); 
        }

        if(isset($filter['email'])){
            $aUsers = $aUsers->where('email', 'LIKE', "%{$filter['email']}%"); 
        }

        if(isset($filter['company_email'])){
            $aUsers = $aUsers->where('company_email', 'LIKE', "%{$filter['company_email']}%"); 
        }

        if(isset($filter['phone'])){
            $aUsers = $aUsers->where('phone', 'LIKE', "%{$filter['phone']}%"); 
        }

        if(isset($filter['tags'])){
            $aRows = $aRows->where('tags', 'LIKE', "%{$filter['tags']}%");
        }

        $aUsers = $aUsers->paginate(12);

        $aUsers->appends(['full_name' => @$filter['full_name'], 'company_name' => @$filter['company_name'], 'email' => @$filter['email'], 'company_email' => @$filter['company_email'], 'phone' => @$filter['phone'], 'tags' => @$filter['tags']]);

        return view("contacts.index", compact("aUsers"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $aRow = array();
        return view('contacts.add', compact('aRow'));
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
        // dd($request->all());
        $aUser = $this->savecontact($request);
        return redirect('contact')->with('message', 'New Contact Added Successfully.');
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
        $aRow = Contact::findOrFail($id);

        return view('contacts.add', compact('aRow'));
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
        $aUser = $this->savecontact($request, $id);
        return redirect('contact')->with('message', 'Contact updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aRow = Contact::findOrFail($id);
        $aRow->delete();
        return redirect('contact')->with('message', 'Contact deleted Successfully.');
    }

    private function savecontact(Request $request, $id = 0)
    {
        $aPosts = $request->all();
        unset($aPosts['_token']);
        $aPosts['updated_by'] = Auth::user()->id;

        if (isset($id) && $id > 0) {
            $aUser = Contact::find($id);
            $aUser->update($aPosts);
        } else {
            $aPosts['status'] = 1;
            $aPosts['admin_id'] = Auth::user()->admin_id;
            $aPosts['created_by'] = Auth::user()->id;
            $aUser = Contact::create($aPosts);
        }

        return true;

    }
}
