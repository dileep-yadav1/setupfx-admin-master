@extends('layouts.master')

@section('title')
    @lang('translation.Message_List')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('title')
            Message List
        @endslot
    @endcomponent

    <div class="d-lg-flex">
        <div class="chat-leftsidebar me-lg-3 col-xl-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>@lang('translation.Message')</h4>
                        </div>
                        <div class="col-md-6" style="text-align: end">
                            <a href="{{ route('messages.create') }}" class="btn btn-primary"><i
                                    class="fas fa-paper-plane"></i> Send</a>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <form action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="Start Typing..."
                                        name="search_user" id="search_user">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-info">Go</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="mt-4">
                        <ul class="list-group" id="user_filter_data">
                            @if ($aRows)
                                @foreach ($aRows as $key => $aRow)
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-1">
                                                @php
                                                    $key = "Overview";
                                                @endphp
                                                <a href="{{ (Auth::user()->role_id == config('constant.ADMIN_ROLE')) ? url('staff/'.$aRow->user_id.'/'.$key) : '#' }}">
                                                    <i class="far fa-square"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-11">
                                                <a href="{{ route('messages.show', $aRow->id) }}">
                                                    <span>{{ $aRow->name }}</span>
                                                </a><br>
                                                <span class="d-flex"><i class="fas fa-reply"></i>
                                                    &nbsp;&nbsp;{!! $aRow->latest_msg !!}</span>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $("#search_user").on('keyup',function(){
                var user = $(this).val();
                console.log(user);
                $("#user_filter_data").html('');
                $.ajax({
                    url: "{{ url('messages/search_user') }}",
                    type: "GET",
                    data: {
                        user: user,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {

                    }
                });
            });
        });
    </script>
@endsection
