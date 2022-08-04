@extends('layouts.master')

@section('title') @if($aRow) Edit @else Add @endif Event @endsection

@section('content')

@component('components.breadcrumb')
    @slot('li_1') Dashboard @endslot
    @slot('li_2') Todo List @endslot
    @slot('title') @if($aRow) Edit @else Add @endif Event @endslot
@endcomponent

<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-body">
                @if($aRow)
                <form method="POST"  action="{{ route('todo.update',$aRow->id) }}" enctype="multipart/form-data">
                @method('PUT')
                @else
                <form method="POST"  action="{{ route('todo.store') }}" enctype="multipart/form-data">
                @endif
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-title-input" class="form-label">Title</label>
                                <input type="text" id="title" name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow->title : old('title') }}"o  placeholder="Title">
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-venue-input" class="form-label">Venue</label>
                                <input type="text" id="venue" name="venue" class="form-control{{ $errors->has('venue') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow->venue : old('venue') }}"o  placeholder="venue">
                                @if ($errors->has('venue'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('venue') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="formrow-desc-input" class="form-label">Description</label>
                        <textarea name="desc" id="desc" cols="30" rows="10" class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}">{{ $aRow ? $aRow->desc : old('desc') }}</textarea>
                        @if ($errors->has('desc'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('desc') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-start_date-input" class="form-label">Start Date</label>
                                <input type="date" id="start_date" class="form-control{{ $errors->has('start_date') ? ' is-invalid' : '' }}" name="start_date" placeholder="Start Date" value="{{ $aRow ? date("Y-m-d", strtotime($aRow->start_date)) : '' }}{{ old('start_date') ? date("Y-m-d", strtotime(old('start_date'))) : ''}}">
                                @if ($errors->has('start_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-end_date-input" class="form-label">End Date</label>
                                <input type="date" id="end_date" class="form-control{{ $errors->has('end_date') ? ' is-invalid' : '' }}" name="end_date" autocomplete="new-password" placeholder="End Date" value="{{ $aRow ? date("Y-m-d", strtotime($aRow->end_date)) : '' }}{{ old('end_date') ? date("Y-m-d", strtotime(old('end_date'))) : ''}}">
                                @if ($errors->has('end_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('end_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-end_date-input" class="form-label">Calendar</label>
                                <select name="calendar" id="calendar" class="form-control{{ $errors->has('calendar') ? ' is-invalid' : '' }}">
                                    @foreach (\CustomHelper::getCalendarList() as $key => $item)
                                        @php $selected = ''; @endphp
                                        @if($aRow)
                                            @if($aRow['calendar'] == $key)
                                                @php $selected = 'selected'; @endphp
                                            @endif
                                        @else
                                            @if(old('calendar') == $key)
                                                @php $selected = 'selected'; @endphp
                                            @endif                                
                                        @endif
                                        <option value="{{ $key }}" {{ $selected }}>{{ $item }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('calendar'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('calendar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-desc-input" class="form-label">Project</label>
                                <input type="text" id="project" name="project" class="form-control{{ $errors->has('project') ? ' is-invalid' : '' }}" placeholder="Project" value="{{ $aRow ? $aRow->project : old('project') }}">
                                @if ($errors->has('project'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('project') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-attendees-input" class="form-label">Attendees</label>
                                <input type="text" id="attendees" name="attendees" class="form-control{{ $errors->has('attendees') ? ' is-invalid' : '' }}" placeholder="Attendees" value="{{ $aRow ? $aRow->attendees : old('attendees') }}">
                                @if ($errors->has('attendees'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('attendees') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-event_color-input" class="form-label">Event Color</label>
                                <input type="color" id="event_color" name="event_color" class="form-control{{ $errors->has('event_color') ? ' is-invalid' : '' }} form-control-color mw-100" placeholder="event_color" value="{{ $aRow ? $aRow->event_color : old('event_color') }}">
                                @if ($errors->has('event_color'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('event_color') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-alert-input" class="form-label">Alert</label>
                                <select id="alert" name="alert" class="form-control{{ $errors->has('alert') ? ' is-invalid' : '' }}">
                                    @foreach (\CustomHelper::getAlertList() as $key => $item)
                                        @php $selected = ''; @endphp
                                        @if($aRow)
                                            @if($aRow['alert'] == $key)
                                                @php $selected = 'selected'; @endphp
                                            @endif
                                        @else
                                            @if(old('alert') == $key)
                                                @php $selected = 'selected'; @endphp
                                            @endif                                
                                        @endif
                                        <option value="{{ $key }}" {{ $selected }}>{{ $item }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('alert'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('alert') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="formCheck1">
                            <label class="form-check-label" for="formCheck1">Not visible to other users</label>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                    </div>
                </form>
        </div>
    <!-- end card body -->
    </div>
<!-- end card -->
</div>

{{--  </div>  --}}

@endsection
