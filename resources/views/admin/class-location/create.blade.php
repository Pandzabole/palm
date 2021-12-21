@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-left"> Create class location </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('class-location.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6 @if($errors->has('location')) has-danger @endif">
                                <label for="location">Create class location </label>
                                <input id="location" class="form-control" placeholder="Create class location"
                                       name="location"
                                       value="{{ old('location')}}" required>
                                @if($errors->has('location'))
                                    <span class="text-danger">*{{ $errors->first('location') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col ml-auto mr-auto text-right">
                                <a href="{{ route('class-location.index') }}" class="btn"> Cancel </a>
                                <button type="submit" class="btn btn-primary"> Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-links')
    @parent

    <script src="{{ asset('js/media-model.js') }}"></script>

@endsection

