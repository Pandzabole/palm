@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-left"> Create Activity </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('activities.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6 @if($errors->has('title')) has-danger @endif">
                                <label for="title">Title</label>
                                <input id="title" class="form-control" placeholder="Title"
                                       name="title"
                                       value="{{ old('title')}}" required>
                                @if($errors->has('title'))
                                    <span class="text-danger">*{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 @if($errors->has('categories')) has-danger @endif">
                                <label for="categories" class="asterisk">Categories</label>
                                <select class="form-control category-search" id="categories"
                                        data-toggle="select" multiple data-placeholder="Categories" required
                                        name="categories[]">
                                    @foreach($categories as $id => $name)
                                        <option
                                            value="{{ $id }}" {{ (collect(old('categories'))->contains($id)) ? 'selected':'' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if($errors->has('categories'))
                                    <span class="text-danger">*{{ $errors->first('categories') }}</span>
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
                                <a href="{{ route('activities.index') }}" class="btn"> Cancel </a>
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
