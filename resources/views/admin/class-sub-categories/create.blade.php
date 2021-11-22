@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-left"> Create sub category </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('sub-categories.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6 @if($errors->has('name')) has-danger @endif">
                                <label for="name">Sub category name</label>
                                <input id="name" class="form-control" placeholder="Sub category name"
                                       name="name"
                                       value="{{ old('name')}}" required>
                                @if($errors->has('name'))
                                    <span class="text-danger">*{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col ml-auto mr-auto text-right">
                                <a href="{{ route('sub-categories.index') }}" class="btn"> Cancel </a>
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
