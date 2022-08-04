@extends('layouts.master')

@section('title')
    @lang('translation.Staff_List')
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('title')
            Staff List
        @endslot
    @endcomponent

    <div class="accordion mt-2 mb-2" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Filter
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse {{ (Request::get('name') || Request::get('email')) ? 'show' : '' }} " aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                <div class="accordion-body">
                    <div class="text-muted">
                        <form method="GET" action="{{ route('staff.index') }}">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="formrow-name-input" class="form-label">Name</label>
                                    <input type="text" id="name" name="name" class="form-control" value="{{ Request::get('name') }}" placeholder="Name">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="formrow-email-input" class="form-label">Email</label>
                                    <input type="text" id="email" name="email" class="form-control" value="{{ Request::get('email') }}" placeholder="Email">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="formrow-firstname-input" class="d-block">&nbsp;</label>
                                    <button type="submit" class="btn btn-success w-md">Submit</button>
                                    <a href="{{ route('staff.index') }}" class="btn btn-danger w-md">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    @can('admin_staff_create')
                        <div class="d-flex flex-wrap gap-2 mb-4 justify-content-md-end">
                            <a class="btn btn-primary waves-effect waves-light" href="{{ route('staff.create') }}"
                                role="button">Add new staff</a>
                        </div>
                    @endcan
                    @if (count($aUsers))
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 70px;">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        @can('admin_staff_status')
                                            <th scope="col">Status</th>
                                        @endcan
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($aUsers as $aKey => $aUser)
                                        <tr>
                                            <td>
                                                @if ($aUser->avatar)
                                                    <img class="rounded-circle avatar-xs"
                                                        src="{{ CustomHelper::displayImage($aUser->avatar) }}"
                                                        alt="">
                                                @else
                                                    <div class="avatar-xs">
                                                        <span class="avatar-title rounded-circle">
                                                            D
                                                        </span>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <h5 class="font-size-14 mb-1"><a href="#"
                                                        class="text-dark">{{ $aUser->name }}</a></h5>

                                            </td>
                                            <td>{{ $aUser->email }}</td>

                                            @can('admin_staff_status')
                                                <td>
                                                    @if ($aUser->status == 1)
                                                        <a href="{{ route('staff.change_status', [$aUser->id, 0]) }}">
                                                            <span class="btn btn-success waves-effect waves-light">Active</span>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('staff.change_status', [$aUser->id, 1]) }}">
                                                            <span
                                                                class="btn btn-danger waves-effect waves-light">Inactive</span>
                                                        </a>
                                                    @endif
                                                </td>
                                            @endcan

                                            <td>
                                                <ul class="list-inline font-size-20 contact-links mb-0">
                                                    @can('admin_staff_list')
                                                        <li class="list-inline-item ">
                                                            @php
                                                                $key = "Overview";
                                                            @endphp
                                                            <a href="{{ url('staff/'.$aUser->id.'/'.$key) }}" title="View User">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </li>
                                                    @endcan
                                                    @can('admin_staff_edit')
                                                        <li class="list-inline-item ">
                                                            <a href="{{ route('staff.edit', $aUser->id) }}" title="Edit User">
                                                                <i class="bx bx bx-edit-alt"></i>
                                                            </a>
                                                        </li>
                                                    @endcan
                                                    @can('admin_staff_destroy')
                                                        <li class="list-inline-item ">
                                                            <a title="Delete User" href="javascript:void(0);"
                                                                onclick="jQuery('#delete-form-{{ $aUser->id }}').submit();">
                                                                <i class="bx bx-trash-alt"></i>
                                                            </a>
                                                            <form id="delete-form-{{ $aUser->id }}"
                                                                onsubmit="return confirm('Are you sure to delete?');"
                                                                action="{{ route('staff.destroy', $aUser->id) }}"
                                                                method="post" style="display: none;">
                                                                {{ method_field('DELETE') }}
                                                                {{ csrf_field() }}
                                                            </form>
                                                        </li>
                                                    @endcan
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $aUsers->links('components.pagination') }}
                    @else
                        No data found
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
