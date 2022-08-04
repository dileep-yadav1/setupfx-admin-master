@php
$showFilter = "";
$arrFilter = ['full_name', 'company_name', 'email', 'company_email', 'phone', 'tags'];
@endphp
@if(count(array_intersect(collect(array_filter(collect(Request::all())->toArray(), 'strlen'))->keys()->toArray(), $arrFilter)) > 0)
    @php  $showFilter = "show"; @endphp
@endif

@extends('layouts.master')

@section('title') @lang('translation.Contact_List') @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Dashbaord @endslot
        @slot('title') Contacts List @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            @can('admin_staff_create')
                <div class="d-flex flex-wrap gap-2 mb-4 justify-content-md-end">
                    <a class="btn btn-primary waves-effect waves-light" href="{{ route('contact.create') }}" role="button">Add new contact</a>
                </div>
            @endcan
        </div>
    </div>

    <div class="accordion mt-2 mb-2" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Filter
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse {{$showFilter}} " aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                <div class="accordion-body">
                    <div class="text-muted">
                        <form method="GET" action="{{ route('contact.index') }}">
                            <div class="row">
                                <div class="col-lg-4 mb-3">
                                    <label for="formrow-firstname-input" class="form-label">Full Name</label>
                                    <input type="text" id="full_name" name="full_name" class="form-control" value="{{ Request::get('full_name') }}" placeholder="Full Name">
                                </div>
                                @php  $salesAgent = \CustomHelper::getsalesagents(); @endphp
                                <div class="col-lg-4 mb-3">
                                    <label for="formrow-firstname-input" class="form-label">E-Mail</label>
                                    <input type="text" id="email" name="email" class="form-control" value="{{ Request::get('email') }}" placeholder="E-Mail">
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="formrow-firstname-input" class="form-label">Phone</label>
                                    <input type="text" id="phone" name="phone" class="form-control" value="{{ Request::get('phone') }}" placeholder="Phone Number">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 mb-3">
                                    <label for="basicpill-firstname-input">Company Name</label>
                                    <input type="text" id="company_name" name="company_name" class="form-control" value="{{ Request::get('company_name') }}" placeholder="Company Name">
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="formrow-firstname-input" class="form-label">Company Email</label>
                                    <input type="text" id="company_email" name="company_email" class="form-control" value="{{ Request::get('company_email') }}" placeholder="Company Email">
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="formrow-firstname-input" class="form-label">Tags</label>
                                    <input type="text" id="tags" name="tags" class="form-control" value="{{ Request::get('tags') }}" placeholder="Tags">
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="formrow-firstname-input" class="d-block">&nbsp;</label>
                                <button type="submit" class="btn btn-success w-md">Submit</button>
                                <a href="{{ route('contact.index') }}" class="btn btn-danger w-md">Reset</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @if(count($aUsers))
            @foreach($aUsers as $aKey => $aUser)
                <div class="col-xl-4 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-4">
                                    <div class="avatar-sm mx-auto mb-3 mt-1">
                                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-16">
                                            {{ $aUser->full_name[0] }}
                                        </span>
                                    </div>
                                </div>

                                <div class="flex-grow-1 overflow-hidden">
                                    @php
                                        $key = 'conversations';
                                    @endphp
                                    <h5 class="text-truncate font-size-15"><a href="{{ url('contact') }}/{{ $aUser->id }}/{{ $key }}" class="text-dark">{{ $aUser->full_name }}</a></h5>
                                    <p class="text-muted mb-1"><b>Email&nbsp;&nbsp;&nbsp;&nbsp;:</b> {{ $aUser->email }}</p>
                                    <p class="text-muted mb-4"><b>Mobile :</b> {{ $aUser->phone }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 border-top">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item me-3">
                                    <span class="badge bg-success">Completed</span>
                                </li>
                                <li class="list-inline-item me-3">
                                    <i class="bx bx-calendar me-1"></i> {{ date("d M, y", strtotime($aUser->created_at)) }}
                                </li>
                                <li class="list-inline-item me-3">
                                    <i class="bx bx-comment-dots me-1"></i> 0
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-12">
                <div class="text-right my-3">
                    {{ $aUsers->links('components.pagination') }}
                </div>
            </div> <!-- end col-->
        @else
            <div class="col-12"> No data found </div>
        @endif
    </div>
    <!--  end row -->
@endsection
