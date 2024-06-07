@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible message-alert text-white z-index-2" role="alert">
        <i class="fa fa-check-circle"></i>
        <span class="pr-20 pl-20">{{session('success')}}</span>
        <a href="javascript:void(0);" class="text-white" onclick="alertClose();"><i class="fa fa-times"></i></button>
    </div>
@endif

@if (session()->has('error'))
    <div class="alert alert-info alert-dismissible message-alert text-white z-index-2" role="alert">
        <i class="fa fa-times-circle"></i>
        @if (is_array(session('error')))
            @foreach (session('error') as $error)
                <span class="pr-20 pl-20">{{ $error[0] }}</span>
            @endforeach
        @else
            <span class="pr-20 pl-20">{{ session('error') }}</span>
        @endif
        <a href="javascript:void(0);" class="text-white" onclick="alertClose();"><i class="fa fa-times"></i></a>
    </div>
@endif
