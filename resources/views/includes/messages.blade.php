@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible message-alert z-index-2" role="alert">
        <i class="fa fa-check-circle"></i>
        <span class="px-2">{{session('success')}}</span>
        <a href="javascript:void(0);" style="color: inherit; margin-left: 20px;" onclick="alertClose();"><i class="fa fa-times"></i></button>
    </div>
@endif

@if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible message-alert z-index-2" role="alert">
        <i class="fa fa-times-circle"></i>
        @if (is_array(session('error')))
            @foreach (session('error') as $error)
                <span class="px-2">{{ $error[0] }}</span>
            @endforeach
        @else
            <span class="px-2">{{ session('error') }}</span>
        @endif
        <a href="javascript:void(0);" style="color: inherit; margin-left: 20px;" onclick="alertClose();"><i class="fa fa-times"></i></a>
    </div>
@endif
