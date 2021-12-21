@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('class-location.update', $classLocation->id) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-left"> Edit class location </h4>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6 error-danger">
                                <div class="form-group  @if($errors->has('location')) has-danger @endif">
                                    <label for="location">Location</label>
                                    <input id="location" type="text" class="form-control" placeholder="Location" name="location"
                                           value="{{ old('location') ?? $classLocation->location }}" required>
                                    @if($errors->has('location'))
                                        <span class="text-danger">*{{ $errors->first('location') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col ml-auto mr-auto text-right mt-4">
                                <a href="{{ route('class-location.index') }}" class="btn"> Cancel </a>
                                <button id="submit" type="submit" class="btn btn-primary"> Save class location</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
