@extends('layouts.master')

@section('title') Notes @endsection

@section('content')

@component('components.breadcrumb')
    @slot('li_1') Dashboard @endslot
    @slot('li_2') Notes @endslot
    @slot('title') @if($aRow) Edit @endif Notes @endslot
@endcomponent

    <div class="row">
        <div class="chat-leftsidebar me-lg-3 col-xl-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="">
                        @can('admin_note_create')
                        <div class="text-end mb-2">
                            <a href="{{ url('note') }}" class="btn btn-md btn-success">Add Note</a>
                        </div>
                        @endcan
                        {{-- <div class="row">
                            <div class="col-md-12">
                                <div class="title d-flex justify-content-between">
                                    <h2 class="text-left">Hello World!</h2>
                                    <span class="text-end">
                                        <a>Right</a>
                                    </span>
                                </div>
                            </div>
                        </div> --}}
                        <div class="card shadow-none mb-2">
                            @if($aRows)
                                @foreach($aRows as $key => $value)
                                    @php $active = "" @endphp
                                    @if($aRow && $value->id == $aRow['id'])
                                    @php $active = "active" @endphp
                                    @endif
                                    <div class="card border mb-2 p-2 setting_menu {{ $active }}">
                                        <div class="title d-flex justify-content-between ">
                                            <a href="{{ route('note.edit', $value->id ) }}">
                                                <h5 class="text-left fw-bold text-truncate">{{ $value->title }}</h4>
                                            </a>
                                            <span class="text-end">
                                                @can('admin_note_destroy')
                                                    <a title="Delete User" href="javascript:void(0);" onclick="jQuery('#delete-form-{{$value->id}}').submit();">
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                    </a>
                                                    <form id="delete-form-{{$value->id}}" onsubmit="return confirm('Are you sure to delete?');" action="{{ route('note.destroy',$value->id) }}" method="post" style="display: none;">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    </form>
                                                @endcan
                                            </span>
                                        </div>
                                        <div>
                                            <p class="fw-bold text-truncate">{{ $value->desc }}</p>
                                            <p class="">{{ date("M d, h:i A", strtotime($value->updated_at)) }}</p>
                                        </div>
                                        {{-- <a href="{{ route('note.edit', $value->id ) }}" class="text-body">
                                            <div class="overflow-hidden p-2 setting_menu ">
                                                <div class="row title">
                                                    <a href="#"><i class="fa fa-times" aria-hidden="true"></i>
                                                    <p class="font-size-13 fw-bold text-truncate">{{ $value->title }}</p>
                                                    </a>
                                                </div>
                                                
                                            </div>
                                        </a> --}}
                                    </div>
                                @endforeach
                            @endif
                        </div>


                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    @if($aRow)
                        <form method="POST" action="{{ route('note.update', $aRow->id) }}" enctype="multipart/form-data" id="AdminForm" name="AdminForm">
                        @method('PUT')
                    @else
                        <form method="POST" action="{{ route('note.store') }}" enctype="multipart/form-data" id="AdminForm" name="AdminForm">
                    @endif
                        @csrf
                        <div class="mb-3">
                            <label for="formrow-firstname-input" class="form-label">Title</label>
                            <input type="text" id="title" name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['title'] : old('title') }}" placeholder="Enter Title Here.">
                            @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="formrow-firstname-input" class="form-label">Note</label>
                            <textarea id="desc" name="desc" rows="20" class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}" placeholder="Notes...">{{ $aRow ? $aRow['desc'] : old('desc') }}</textarea>
                            @if ($errors->has('desc'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('desc') }}</strong>
                                </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                    </form>
                </div>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
</div>

@endsection
