@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-left"> Edit News </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('news.update', $news->id)}}" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-row">
                            <div class="form-group col-md-6 @if($errors->has('title')) has-danger @endif">
                                <label for="title">Title</label>
                                <input id="title" class="form-control" placeholder="Title"
                                       name="title"
                                       value="{{ old('title') ?? $news->title }}" required>
                                @if($errors->has('title'))
                                    <span class="text-danger">*{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="categories">Categories</label>
                                <select class="selectpicker form-control"
                                        data-toggle="select" multiple data-placeholder="Categories" required
                                        multiple id="categories" name="categories[]">
                                    @foreach($categories as $category)
                                        <option @if(in_array($category->id, $selectedCategories, true)) selected
                                                @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col form-group @if($errors->has('description')) has-danger @endif">
                                <label for="description">Description</label>
                                <textarea id="description" class="form-control" placeholder="Description"
                                          name="description" rows="4" cols="50"
                                          required>{{ old('description') ?? $news->description }}</textarea>
                                @if($errors->has('description'))
                                    <span class="text-danger">*{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="asterisk">Image</label>
                                @include('partials.media.form', [
                                    'inputName' => 'image',
                                    'exists' => true,
                                    'mediaId'=> optional($news->firstMedia())->id,
                                    'mediaUrl' => $news->firstMediaUrl(),
                                    'mediaModal' => 'media-modal-image'
                                ])
                                <p class="form-control-label">
                                    Recommended dimensions: highlighted news - 1110x412px (other news 255x200px -
                                    central crop)
                                </p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col ml-auto mr-auto text-right">
                                <a href="{{ route('news.index') }}" class="btn"> Cancel </a>
                                <button type="submit" class="btn btn-primary"> Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('vendor.content.content-table', ['resource' => $news])
@endsection

@include('partials.media.media-modal', ['mediaModalId' => 'image'])

@section('js-links')
    @parent

    <script src="{{ asset('js/media-model.js') }}"></script>

@endsection
