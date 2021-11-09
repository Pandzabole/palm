@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-left"> Edit Product </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('products.update', $product->id)}}"
                          enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group @if($errors->has('name')) has-danger @endif">
                                    <label for="name">Name</label>
                                    <input id="name" class="form-control" placeholder="Name"
                                           name="name"
                                           value="{{ old('name') ?? $product->name }}" required>
                                    @if($errors->has('name'))
                                        <span class="text-danger">*{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 pl-3">
                                <div class="form-group">
                                    <label for="package_number">Package number</label>
                                    <select class="form-control"
                                            id="package_number"
                                            name="package_number_id">
                                        @foreach($packageNumber as $number)
                                            <option @if($number->id === $product->package_number_id) selected
                                                    @endif value="{{ $number->id }}">{{ $number->value }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger d-none error-span error-package_volume"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 pl-3">
                                <div class="form-group">
                                    <label for="package_volume">Package volume</label>
                                    <select class="form-control"
                                            id="package_volume"
                                            name="package_volume_id">
                                        @foreach($packageVolume as $volume)
                                            <option @if($volume->id === $product->package_volume_id) selected
                                                    @endif value="{{ $volume->id }}">{{ $volume->value }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger d-none error-span error-package_volume"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group @if($errors->has('description')) has-danger @endif">
                                    <label for="description">Description</label>
                                    <textarea id="description" class="form-control" placeholder="Description"
                                              name="description"
                                              required>{{ old('description') ?? $product->description }}</textarea>
                                    @if($errors->has('description'))
                                        <span class="text-danger">*{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div
                                class="form-group col-md-6 error-danger error-danger-image_desktop error-danger-media_desktop_id">
                                <label class="asterisk"> Image Desktop</label>
                                @include('partials.media.form', [
                                        'mediaUrl' => $product->desktopImage()->getUrl(),
                                        'inputName' => "image_desktop",
                                        'mediaName' => "media_desktop_id",
                                        'deleteName' => "desktop_deleted",
                                        'exists' => true,
                                        'resource' => $product,
                                        'mediaModal' => 'media-modal-desktop'

                                   ])
                                <p class="form-control-label">Required image: landscape <span
                                        class="image-desktop-portrait"></span>
                                </p>
                                <span
                                    class="text-danger d-none error-span error-image_desktop error-media_desktop_id"></span>
                            </div>
                            <div
                                class="form-group col-md-6 error-danger error-danger-image_mobile error-danger-media_mobile_id">
                                <label class="asterisk"> Image Mobile</label>
                                @include('partials.media.form', [
                                        'mediaUrl' => $product->mobileImage()->getUrl(),
                                        'inputName' => "image_mobile",
                                        'mediaName' => "media_mobile_id",
                                        'deleteName' => "mobile_deleted",
                                        'exists' => true,
                                        'resource' => $product,
                                        'mediaModal' => 'media-modal-mobile'
                                   ])
                                <p class="form-control-label">Required image: portrait <span
                                        class="image-mobile-portrait"></span>
                                </p>
                                <span
                                    class="text-danger d-none error-span error-image_mobile error-media_mobile_id"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 ml-auto mr-auto text-right">
                                <a href="{{ route('products.index') }}" class="btn"> Cancel </a>
                                <button type="submit" class="btn btn-primary"> Update</button>
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
    @parent

    <script src="{{ asset('js/media-model.js') }}"></script>

@endsection
