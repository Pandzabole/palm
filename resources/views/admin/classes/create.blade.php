@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-left"> Create Class </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('classes.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6 @if($errors->has('name')) has-danger @endif">
                                <label for="name">Class name</label>
                                <input id="name" class="form-control" placeholder="Name"
                                       name="name"
                                       value="{{ old('name')}}" required>
                                @if($errors->has('name'))
                                    <span class="text-danger">*{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 @if($errors->has('classCategory')) has-danger @endif">
                                <label for="categories">Main categories</label>
                                <select class="form-control category-search" id="classCategory"
                                        data-toggle="select" data-placeholder="Filter by categories"
                                        name="class_category_id">
                                    <option value="0">All categories</option>
                                    @foreach($classCategory as $name => $id)
                                        <option value="{{ $name }}">{{ $id }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('classCategory'))
                                    <span class="text-danger">*{{ $errors->first('classCategory') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 @if($errors->has('classSubCategory')) has-danger @endif">
                                <label for="classSubCategory">Sub categories</label>
                                <select class="form-control category-search" id="classSubCategory"
                                        data-toggle="select" data-placeholder="Filter by sub categories"
                                        name="class_sub_category_id">
                                    <option value="0">All sub categories</option>
                                    @foreach($classSubCategory as $name => $id)
                                        <option value="{{ $name }}">{{ $id }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('classSubCategory'))
                                    <span class="text-danger">*{{ $errors->first('classSubCategory') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 @if($errors->has('teacher')) has-danger @endif">
                                <label for="teacher">Teacher</label>
                                <select class="form-control category-search" id="teacher"
                                        data-toggle="select" data-placeholder="Filter by teacher"
                                        name="teacher_id">
                                    <option value="0">All teachers</option>
                                    @foreach($teacher as $name => $id)
                                        <option value="{{ $name }}">{{ $id }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('teacher'))
                                    <span class="text-danger">*{{ $errors->first('teacher') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 @if($errors->has('price')) has-danger @endif">
                                <label for="price">Class price</label>
                                <input id="price" class="form-control" placeholder="Price"
                                       name="price"
                                       value="{{ old('price')}}" required>
                                @if($errors->has('price'))
                                    <span class="text-danger">*{{ $errors->first('price') }}</span>
                                @endif
                            </div>

                            <div class="form-group col-md-6 @if($errors->has('classLocation')) has-danger @endif">
                                <label for="classLocation" class="asterisk">Class Location</label>
                                <select class="form-control category-search" id="classLocation"
                                        data-toggle="select" multiple data-placeholder="Class Location" required
                                        name="class_location[]">
                                    @foreach($classLocation as $id => $name)
                                        <option
                                            value="{{ $id }}" {{ (collect(old('classLocation'))->contains($id)) ? 'selected':'' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if($errors->has('classLocation'))
                                    <span class="text-danger">*{{ $errors->first('classLocation') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 @if($errors->has('description')) has-danger @endif">
                                <label for="description">Description</label>
                                <textarea id="description" class="form-control" placeholder="Description"
                                          name="description" rows="4" cols="50"
                                          required>{{ old('description') }}</textarea>
                                @if($errors->has('description'))
                                    <span class="text-danger">*{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 @if($errors->has('map_location')) has-danger @endif">
                                <label for="map_location">Map location</label>
                                <textarea id="map_location" class="form-control" placeholder="Map location"
                                          name="map_location" rows="2" cols="50"
                                          >{{ old('map_location') }}</textarea>
                                @if($errors->has('map_location'))
                                    <span class="text-danger">*{{ $errors->first('map_location') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="asterisk">Image</label>
                                @include('partials.media.form', ['inputName' => 'image', 'exists' => false, 'mediaModal' => 'media-modal-image'])
                                <p class="form-control-label">
                                    Recommended dimensions: 750x1686px
                                </p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 ml-auto mr-auto text-right">
                                <a href="{{ route('classes.index') }}" class="btn"> Cancel </a>
                                <button type="submit" class="btn btn-primary"> Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('partials.media.media-modal', ['mediaModalId' => 'image'])

@section('js-links')
    @parent

    <script src="{{ asset('js/media-model.js') }}"></script>

@endsection
