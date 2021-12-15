{{--<div class="navbar-wrapper">--}}
{{--    <div class="navbar-toggle">--}}
{{--        <button type="button" class="navbar-toggler">--}}
{{--            <span class="navbar-toggler-bar bar1"></span>--}}
{{--            <span class="navbar-toggler-bar bar2"></span>--}}
{{--            <span class="navbar-toggler-bar bar3"></span>--}}
{{--        </button>--}}
{{--    </div>--}}
{{--    @if (isset($selectedLanguageLayout))--}}
{{--        <div class="btn-group select-language">--}}
{{--            <button type="button"--}}
{{--                    class="btn">{{ data_get($languageList, $selectedLanguageLayout) }}</button>--}}
{{--            <button type="button" class="btn dropdown-toggle dropdown-toggle-split"--}}
{{--                    data-toggle="dropdown"--}}
{{--                    aria-haspopup="true" aria-expanded="false">--}}
{{--                <span class="sr-only">{{ data_get($languageList, $selectedLanguageLayout) }}</span>--}}
{{--            </button>--}}
{{--            <div class="dropdown-menu">--}}
{{--                @foreach($languageList as $code => $language)--}}
{{--                    <a class="dropdown-item"--}}
{{--                       href="{{ route('set-language-layout', ['lang' => $code]) }}">{{ $language }}</a>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endif--}}
{{--    <div class="row">--}}
{{--        <div class="col-md-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">--}}
{{--                    <h4 class="card-title text-left"> Create Class </h4>--}}
{{--                </div>--}}
{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{route('reservation-class.store')}}" enctype="multipart/form-data">--}}
{{--                        @csrf--}}
{{--                        <div class="form-row">--}}
{{--                            <div class="form-group col-md-6 @if($errors->has('name')) has-danger @endif">--}}
{{--                                <label for="name">Class title</label>--}}
{{--                                <input id="name" class="form-control" placeholder="Name"--}}
{{--                                       name="name"--}}
{{--                                       value="{{ old('name')}}" required>--}}
{{--                                @if($errors->has('name'))--}}
{{--                                    <span class="text-danger">*{{ $errors->first('name') }}</span>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                            <div class="form-group col-md-6 @if($errors->has('email')) has-danger @endif">--}}
{{--                                <label for="email">email</label>--}}
{{--                                <input id="email" class="form-control" placeholder="email"--}}
{{--                                       name="email"--}}
{{--                                       value="{{ old('email')}}" required>--}}
{{--                                @if($errors->has('email'))--}}
{{--                                    <span class="text-danger">*{{ $errors->first('email') }}</span>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-row">--}}
{{--                            <div class="form-group col-md-12 @if($errors->has('comment')) has-danger @endif">--}}
{{--                                <label for="comment">comment</label>--}}
{{--                                <textarea id="comment" class="form-control" placeholder="comment"--}}
{{--                                          name="comment" rows="4" cols="50"--}}
{{--                                          required>{{ old('comment') }}</textarea>--}}
{{--                                @if($errors->has('comment'))--}}
{{--                                    <span class="text-danger">*{{ $errors->first('comment') }}</span>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-row">--}}
{{--                            <div class="form-group col-md-6 @if($errors->has('phone')) has-danger @endif">--}}
{{--                                <label for="phone">phone</label>--}}
{{--                                <input id="phone" class="form-control" placeholder="phone"--}}
{{--                                       name="phone"--}}
{{--                                       value="{{ old('phone')}}" required>--}}
{{--                                @if($errors->has('phone'))--}}
{{--                                    <span class="text-danger">*{{ $errors->first('phone') }}</span>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-row">--}}
{{--                            <div class="col-12 ml-auto mr-auto text-right">--}}
{{--                                <a href="{{ route('classes.index') }}" class="btn"> Cancel </a>--}}
{{--                                <button type="submit" class="btn btn-primary"> Add</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="row">--}}
{{--                @foreach($classes as $classe)--}}
{{--                   <div>{{$classe->name}}</div>--}}
{{--                   <div>{{$classe->description}}</div>--}}
{{--                @if($session === 'database-ar')--}}
{{--                        <div>{{$classe->price_usd}}</div>--}}
{{--                    @endif--}}
{{--                    @if($session === 'database-en')--}}
{{--                        <div>{{$classe->price_usd}}</div>--}}
{{--                        <div>{{$classe->price_eur}}</div>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--            <div>{{$session}}</div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}


@extends('front-layout.app')

@section('content')

@endsection
