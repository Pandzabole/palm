<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Voda Voda</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700,200" rel="stylesheet"/>
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{ asset('css/argon.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/palmskills.css') }}" type="text/css">

</head>
<body class="bg-default">
<div class="main-content">
{{--    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">--}}
{{--        <div class="separator separator-bottom separator-skew zindex-100">--}}
{{--            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"--}}
{{--                 xmlns="http://www.w3.org/2000/svg">--}}
{{--                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>--}}
{{--            </svg>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="flex-center position-ref-languages full-height" style="margin-top: 20%">
        <div class="content-languages">
            <div class="links">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select language
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @foreach($markets as $market)
                            <a class="dropdown-item"
                               href="{{ route('set-language', ['lang' => $market->short]) }}">{{ $market->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(auth()->user()->isMainAdmin())
    <a href="{{ route('admins.index') }}" class="manage-admins">
        <button class="btn btn-primary">
            Manage admin
        </button>
    </a>
@endif

<a class="logout-languages btn btn-primary" href="{{ route('logout') }}"
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <span>Logout</span>
</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
<script src="{{ asset('js/core/jquery.min.js') }}"></script>

<script src="{{ asset('js/bootstrap.bundle.min.js ') }}"></script>

</body>
</html>
