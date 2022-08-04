@extends('layouts.master')

@section('title')
    @lang('translation.Mail Variable List')
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('title')
            Mail Variable List
        @endslot
    @endcomponent

    <div class="accordion mt-2 mb-2" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Filter
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse {{ (Request::get('variable_key') || Request::get('variable_value')) ? 'show' : '' }} " aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                <div class="accordion-body">
                    <div class="text-muted">
                        <form method="GET" action="{{ route('mail_variables.index') }}">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="formrow-firstname-input" class="form-label">Variable Key</label>
                                    <input type="text" id="variable_key" name="variable_key" class="form-control" value="{{ Request::get('variable_key') }}" placeholder="variable key">
                                </div>
            
                                <div class="col-md-3 mb-3">
                                    <label for="formrow-firstname-input" class="form-label">Variable Value</label>
                                    <input type="test" id="variable_value" name="variable_value" class="form-control" value="{{ Request::get('variable_value') }}" placeholder="variable value">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="formrow-firstname-input" class="d-block">&nbsp;</label>
                                    <button type="submit" class="btn btn-success w-md">Submit</button>
                                    <a href="{{ route('mail_variables.index') }}" class="btn btn-danger w-md">Reset</a>
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

                    @can('admin_email_create')
                        <div class="d-flex flex-wrap gap-2 mb-4 justify-content-md-end">
                            <a class="btn btn-primary waves-effect waves-light" href="{{ route('mail_variables.create') }}"
                                role="button">Add Variable</a>
                        </div>
                    @endcan
                    @if (count($aRows))
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 70px;">#</th>
                                        <th scope="col">Variable Key</th>
                                        <th scope="col">Variable Value</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($aRows as $aKey => $aRow)
                                        <tr>
                                            <td>{{ ++$aKey }}</td>
                                            <td>{{ $aRow->variable_key }}</td>
                                            <td>{{ $aRow->variable_value }}</td>
                                            <td>
                                                <ul class="list-inline font-size-20 contact-links mb-0">
                                                    @can('admin_staff_edit')
                                                        <li class="list-inline-item ">
                                                            <a href="{{ route('mail_variables.edit', $aRow->id) }}"
                                                                title="Edit User">
                                                                <i class="bx bx bx-edit-alt"></i>
                                                            </a>
                                                        </li>
                                                    @endcan
                                                    @can('admin_staff_destroy')
                                                        <li class="list-inline-item ">
                                                            <a title="Delete User" href="javascript:void(0);"
                                                                onclick="jQuery('#delete-form-{{ $aRow->id }}').submit();">
                                                                <i class="bx bx-trash-alt"></i>
                                                            </a>
                                                            <form id="delete-form-{{ $aRow->id }}"
                                                                onsubmit="return confirm('Are you sure to delete?');"
                                                                action="{{ route('mail_variables.destroy', $aRow->id) }}"
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
                    @else
                        No data found
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
