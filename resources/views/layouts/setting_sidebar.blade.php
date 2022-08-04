@component('components.breadcrumb')
    @slot('li_1')
        Dashboard
    @endslot
    @slot('title')
        <span id="bredcrumbName">{{ $settingName }}</span> Setting
    @endslot
@endcomponent
@push('styles')
    <style>
        #bredcrumbName{
            text-transform: capitalize;
        }
        .setting_menu.active {
    background: #0000003d;
}
    </style>
@endpush
<div class="row">
    <div class="chat-leftsidebar me-lg-3 col-xl-3">
        <div class="card overflow-hidden">
            <div class="card-body">
                <div class="">
                    @php $SettingList = \CustomHelper::getSettingList() @endphp
                    @if ($SettingList)
                        @foreach ($SettingList as $key => $value)
                            <div class="card border shadow-none mb-2">
                                <a href="{{ url('/setting') }}/{{ $key }}" class="text-body">
                                    <div class="overflow-hidden p-2 setting_menu {{ $key == $settingName ? 'active' : '' }}">
                                        <span class="font-size-13 fw-bold text-truncate">{{ $value }}</span>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
