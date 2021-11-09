@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-left"> Create Product </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('products.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 pr-3">
                                <div class="form-group @if($errors->has('name')) has-danger @endif">
                                    <label for="name">Name</label>
                                    <input id="name" class="form-control" placeholder="Name"
                                           name="name"
                                           value="{{ old('name')}}" required>
                                    @if($errors->has('name'))
                                        <span class="text-danger">*{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 pl-3">
                                <div class="form-group">
                                    <label for="package-number">Package number</label>
                                    <select class="form-control"
                                            id="package-number"
                                            name="package_number_id">
                                        @foreach($packageNumber as $number)
                                        <option value="{{$number->id}}">{{$number->value}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger d-none error-span error-package_number"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 pl-3">
                                <div class="form-group">
                                    <label for="package-volume">Package volume</label>
                                    <select class="form-control"
                                            id="package-volume"
                                            name="package_volume_id">
                                        @foreach($packageVolume as $volume)
                                            <option value="{{$volume->id}}">{{$volume->value}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger d-none error-span error-package_volume"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 pl-3">
                                <div class="form-group @if($errors->has('description')) has-danger @endif">
                                    <label for="description">Description</label>
                                    <textarea id="description" class="form-control" placeholder="Description"
                                              name="description" rows="6" required>{{ old('description') }}</textarea>
                                    @if($errors->has('description'))
                                        <span class="text-danger">*{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 error-danger">
                                <label class="form-control-label" for="image">Desktop Image</label>
                                @include('partials.media.form', ['inputName' => 'image_desktop', 'mediaName' => 'media_desktop_id',  'mediaModal' => 'media-modal-desktop', 'exists' => false])
                                <p class="form-control-label">Required image: landscape <span
                                        class="image-desktop-portrait"></span>
                                </p>
                                <span class="text-danger d-none error-span"></span>
                            </div>
                            <div class="form-group col-md-6 error-danger">
                                <label class="form-control-label" for="image">Mobile Image</label>
                                @include('partials.media.form', ['inputName' => 'image_mobile', 'mediaName' => 'media_mobile_id', 'mediaModal' => 'media-modal-mobile', 'exists' => false])
                                <p class="form-control-label">Required image: portrait <span
                                        class="image-mobile-portrait"></span>
                                </p>
                                <span class="text-danger d-none error-span"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 ml-auto mr-auto text-right">
                                <a href="{{ route('products.index') }}" class="btn"> Cancel </a>
                                <button type="submit" class="btn btn-primary"> Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('partials.media.media-modal', ['mediaModalId' => 'mobile', 'media' => $mediaMobile])
@include('partials.media.media-modal', ['mediaModalId' => 'desktop', 'media' => $mediaDesktop])

@section('js-links')

    <script src="{{ asset('js/media-model.js') }}"></script>

@endsection

