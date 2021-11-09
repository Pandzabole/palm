@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('pages.update', $page->id) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-left"> Edit Page </h4>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6 error-danger">
                                <div class="form-group @if($errors->has('name')) has-danger @endif">
                                    <label for="name">Name</label>
                                    <input id="name" type="text" class="form-control" placeholder="Name" name="name"
                                           value="{{ old('name') ?? $page->name }}" required>
                                    @if($errors->has('name'))
                                        <span class="text-danger">*{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col ml-auto mr-auto text-right mt-4">
                                <a href="{{ route('pages.index') }}" class="btn"> Cancel </a>
                                <button id="submit" type="submit" class="btn btn-primary"> Save Page</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
