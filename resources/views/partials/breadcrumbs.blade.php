<div class="col-lg-6 col-7">
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item @if(!$action) active @endif" @if(!$action) aria-current="page" @endif>
                @if(\Illuminate\Support\Facades\Route::has($name . '.index'))
                    <a href="{{ route($name . '.index') }}">{{ \Illuminate\Support\Str::title($name) }}</a>
                @else
                    {{ \Illuminate\Support\Str::title($name) }}
                @endif
            </li>
            @if($action)
                <li class="breadcrumb-item active" aria-current="page">{{ \Illuminate\Support\Str::ucfirst($action) }}</li>
            @endif
        </ol>
    </nav>
</div>
