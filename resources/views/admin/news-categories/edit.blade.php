@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-left"> Edit News Category </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('news-categories.update', $newsCategory->id)}}">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="row-row">
                            <div class="form-group col-md-6 @if($errors->has('name')) has-danger @endif">
                                <label for="name">Name</label>
                                <input id="name" type="text" class="form-control datepicker"
                                       value="{{ old('name') ?? $newsCategory->name}}"
                                       name="name" required>
                                @if($errors->has('name'))
                                    <span class="text-danger">*{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col ml-auto mr-auto text-right">
                                <a href="{{ route('news-categories.index') }}" class="btn"> Cancel </a>
                                <button type="submit" class="btn btn-primary"> Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
