@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('misc-information.update', $miscInformation->id) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-left"> Edit {{ $miscInformation->name }} </h4>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6 error-danger">
                                <div class="form-group  @if($errors->has('name')) has-danger @endif">
                                    <label for="name">Name</label>
                                    <input id="name" type="text" class="form-control" placeholder="Name" name="name"
                                           value="{{ old('name') ?? $miscInformation->name }}" required>
                                    @if($errors->has('name'))
                                        <span class="text-danger">*{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-md-6 @if($errors->has('value')) has-danger @endif">
                                <label for="name">Text</label>
                                @if($miscInformation->isLongText())
                                    <textarea id="name" type="text" class="form-control" placeholder="Value"
                                              name="value"
                                              required>{{ old('value') ?? $miscInformation->value }}</textarea>
                                @else
                                    <input id="name" type="text" class="form-control" placeholder="Value"
                                           name="value"
                                           value="{{ old('value') ?? $miscInformation->value }}" required>
                                @endif
                                @if($errors->has('value'))
                                    <span class="text-danger">*{{ $errors->first('value') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col ml-auto mr-auto text-right">
                                <button id="submit" type="submit" class="btn btn-primary"> Save</button>
                                <a href="{{ route('misc-information.index') }}" class="btn"> Cancel </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('js-links')

@endsection
