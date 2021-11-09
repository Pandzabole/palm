@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-left"> Edit meta data </h4>
                </div>
                <div class="card-header">
                    <h4 class="card-title text-left">Page {{$metaData->page->name}} </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('meta-data.update', $metaData->id)}}"
                          enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group @if($errors->has('title')) has-danger @endif">
                                    <label for="title">Title</label>
                                    <input id="title" class="form-control" placeholder="Title"
                                           name="title"
                                           value="{{ old('title') ?? $metaData->title }}" required>
                                    @if($errors->has('title'))
                                        <span class="text-danger">*{{ $errors->first('title') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 pr-1">
                                <div class="form-group @if($errors->has('keywords')) has-danger @endif">
                                    <label for="keywords">Key words</label>
                                    <input id="keywords" class="form-control" placeholder="Keywords"
                                           name="keywords"
                                           value="{{ old('keywords') ?? $metaData->title }}" required>
                                    @if($errors->has('keywords'))
                                        <span class="text-danger">*{{ $errors->first('keywords') }}</span>
                                    @endif
                                    <span>Enter words separated by comma.</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group @if($errors->has('description')) has-danger @endif">
                                    <label for="description">Description</label>
                                    <textarea id="description" class="form-control" placeholder="Description"
                                              name="description" rows="4" cols="50"
                                              required>{{ old('description') ?? $metaData->description }}</textarea>
                                    @if($errors->has('description'))
                                        <span class="text-danger">*{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label class="asterisk">Image</label>
                                @include('partials.media.form', [
                                    'inputName' => 'image',
                                    'exists' => true,
                                    'mediaId'=> optional($metaData->firstMedia())->id,
                                    'mediaUrl' => $metaData->firstMediaUrl(),
                                    'mediaModal' => 'media-modal-image'
                                ])
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 ml-auto mr-auto text-right">
                                <a href="{{ route('meta-data.index') }}" class="btn"> Cancel </a>
                                <button type="submit" class="btn btn-primary"> Update</button>
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

