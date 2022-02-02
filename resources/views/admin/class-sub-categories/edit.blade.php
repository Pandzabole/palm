@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('sub-categories.update', $subCategory->id) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-left"> Edit category </h4>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-lg-6 pl-3">
                                <div class="form-group">
                                    <label for="main_category">Main category</label>
                                    <select class="form-control"
                                            id="main_category"
                                            name="main_category">
                                        @foreach($mainCategory as $id => $name))
                                        <option value="{{$id}}">{{$name}} </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger d-none error-span error-main_category"></span>
                                </div>
                            </div>
                            <div class="form-group col-md-6 error-danger">
                                <div class="form-group  @if($errors->has('name')) has-danger @endif">
                                    <label for="name">Sub category</label>
                                    <input id="name" type="text" class="form-control" placeholder="Name" name="name"
                                           value="{{ old('name') ?? $subCategory->name }}" required>
                                    @if($errors->has('name'))
                                        <span class="text-danger">*{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col ml-auto mr-auto text-right mt-4">
                                <a href="{{ route('sub-categories.index') }}" class="btn"> Cancel </a>
                                <button id="submit" type="submit" class="btn btn-primary"> Save category</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
