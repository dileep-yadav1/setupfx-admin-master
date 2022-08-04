@extends('layouts.master')

@section('title') @lang('translation.todo_List') @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Dashboard @endslot
        @slot('title') Todo List @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                @can('admin_todo_create')
                <div class="d-flex flex-wrap gap-2 mb-4 justify-content-md-end">
                    <a class="btn btn-primary waves-effect waves-light" href="{{ route('todo.create') }}" role="button">Add Event</a>
                </div>
                @endcan
                    <div class="col-lg-8">
                        <div class="row mx-md-n2">
                            <div class="col px-md-2">
                                <div class="tododiv p-2 border">
                                    <h5>Today - {{ date("M d, Y") }}</h5>
                                    <hr>
                                    @if($today_list)
                                        @foreach ($today_list as $item)
                                            <div class="p-2 text-white mb-1 border rounded" style="background-color: {{ $item->event_color }}">
                                                <div class="title d-flex justify-content-between ">
                                                    <h5 class="text-left fw-bold text-truncate text-white">{{ $item->title }} ( {{ $item->venue }} )</h4>
                                                    <span class="text-end">
                                                        @can('admin_todo_edit')
                                                            <a class="text-white" title="Delete Event" href="{{ route('todo.edit', $item->id ) }}">
                                                                <i class="bx bx-pencil" aria-hidden="true"></i>
                                                            </a>
                                                        @endcan
                                                        @can('admin_todo_destroy')
                                                            <a class="text-white" title="Delete Event" href="javascript:void(0);" onclick="jQuery('#delete-form-{{$item->id}}').submit();">
                                                                <i class="fa fa-times" aria-hidden="true"></i>
                                                            </a>
                                                            <form id="delete-form-{{$item->id}}" onsubmit="return confirm('Are you sure to delete?');" action="{{ route('todo.destroy',$item->id) }}" method="post" style="display: none;">
                                                            {{ method_field('DELETE') }}
                                                            {{ csrf_field() }}
                                                            </form>
                                                        @endcan
                                                    </span>
                                                </div>
                                                <p><i class="bx bx-time-five" aria-hidden="true"></i>{{ date("M d, Y", strtotime($item->start_date)) }} - {{ date("M d, Y", strtotime($item->end_date)) }}</p>
                                                <p><i class="bx bx-timer" aria-hidden="true"></i> {{ CustomHelper::getEventReminderTime($item->alert) }}</p>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col px-md-2">
                                <div class="tododiv p-2 border">
                                    <h5>Tomorrow - {{ date("M d, Y", strtotime("+1 day")) }}</h5>
                                    <hr>
                                    @if($tomorrow_list)
                                        @foreach ($tomorrow_list as $item)
                                            <div class="p-2 text-white mb-1 border rounded" style="background-color: {{ $item->event_color }}">
                                                <div class="title d-flex justify-content-between ">
                                                    <h5 class="text-left fw-bold text-truncate text-white">{{ $item->title }} ( {{ $item->venue }} )</h4>
                                                    <span class="text-end">
                                                        @can('admin_todo_edit')
                                                            <a class="text-white" title="Delete Event" href="{{ route('todo.edit', $item->id ) }}">
                                                                <i class="bx bx-pencil" aria-hidden="true"></i>
                                                            </a>
                                                        @endcan
                                                        @can('admin_todo_destroy')
                                                            <a class="text-white" title="Delete Event" href="javascript:void(0);" onclick="jQuery('#delete-form-{{$item->id}}').submit();">
                                                                <i class="fa fa-times" aria-hidden="true"></i>
                                                            </a>
                                                            <form id="delete-form-{{$item->id}}" onsubmit="return confirm('Are you sure to delete?');" action="{{ route('todo.destroy',$item->id) }}" method="post" style="display: none;">
                                                            {{ method_field('DELETE') }}
                                                            {{ csrf_field() }}
                                                            </form>
                                                        @endcan
                                                    </span>
                                                </div>
                                                <p><i class="bx bx-time-five" aria-hidden="true"></i>{{ date("M d, Y", strtotime($item->start_date)) }} - {{ date("M d, Y", strtotime($item->end_date)) }}</p>
                                                <p><i class="bx bx-timer" aria-hidden="true"></i> {{ CustomHelper::getEventReminderTime($item->alert) }}</p>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col px-md-2">
                                <div class="tododiv p-2 border">
                                    <h5>This week</h5>
                                    <hr>
                                    @if($week_list)
                                        @foreach ($week_list as $item)
                                            <div class="p-2 text-white mb-1 border rounded" style="background-color: {{ $item->event_color }}">
                                                <div class="title d-flex justify-content-between ">
                                                    <h5 class="text-left fw-bold text-truncate text-white">{{ $item->title }} ( {{ $item->venue }} )</h4>
                                                    <span class="text-end">
                                                        @can('admin_todo_edit')
                                                            <a class="text-white" title="Delete Event" href="{{ route('todo.edit', $item->id ) }}">
                                                                <i class="bx bx-pencil" aria-hidden="true"></i>
                                                            </a>
                                                        @endcan
                                                        @can('admin_todo_destroy')
                                                            <a class="text-white" title="Delete Event" href="javascript:void(0);" onclick="jQuery('#delete-form-{{$item->id}}').submit();">
                                                                <i class="fa fa-times" aria-hidden="true"></i>
                                                            </a>
                                                            <form id="delete-form-{{$item->id}}" onsubmit="return confirm('Are you sure to delete?');" action="{{ route('todo.destroy',$item->id) }}" method="post" style="display: none;">
                                                            {{ method_field('DELETE') }}
                                                            {{ csrf_field() }}
                                                            </form>
                                                        @endcan
                                                    </span>
                                                </div>
                                                <p><i class="bx bx-time-five" aria-hidden="true"></i>{{ date("M d, Y", strtotime($item->start_date)) }} - {{ date("M d, Y", strtotime($item->end_date)) }}</p>
                                                <p><i class="bx bx-timer" aria-hidden="true"></i> {{ CustomHelper::getEventReminderTime($item->alert) }}</p>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
@endsection

