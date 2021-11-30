@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-left"> Edit Class </h4>
                </div>
                <div class="card-body">
                        <form method="POST"action="{{route('classes.update', $class->id)}}">
                            @csrf
                            {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group @if($errors->has('name')) has-danger @endif">
                                    <label for="name">Class title</label>
                                    <input id="name" class="form-control" placeholder="Name"
                                           name="name"
                                           value="{{ old('name') ?? $class->name }}" required>
                                    @if($errors->has('name'))
                                        <span class="text-danger">*{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 pl-3">
                                <div class="form-group">
                                    <label for="class_category_id">Main category</label>
                                    <select class="form-control"
                                            id="class_category_id"
                                            name="class_category_id">
                                        @foreach($classCategory as $id => $name))
                                        <option @if($id === $class->classCategory->id) selected
                                                @endif value="{{$id}}">{{$name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger d-none error-span error-class_category_id"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 pl-3">
                                <div class="form-group">
                                    <label for="class_sub_category_id">Sub category</label>
                                    <select class="form-control"
                                            id="class_sub_category_id"
                                            name="class_sub_category_id">
                                        @foreach($classSubCategory as $id => $name))
                                        <option @if($id === $class->classSubCategory->id) selected
                                                @endif value="{{$id}}">{{$name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger d-none error-span error-class_sub_category_id"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 pl-3">
                                <div class="form-group">
                                    <label for="teacher_id">Teacher</label>
                                    <select class="form-control"
                                            id="teacher_id"
                                            name="teacher_id">
                                        @foreach($teacher as $id => $name))
                                        <option @if($id === $class->teacher->id) selected
                                                @endif value="{{$id}}">{{$name}} </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger d-none error-span error-teacher_id"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group @if($errors->has('price_usd')) has-danger @endif">
                                    <label for="price_usd">Class price in USD</label>
                                    <input id="price_usd" class="form-control" placeholder="USD price"
                                           name="price_usd"
                                           value="{{ old('price_usd') ?? $class->price_usd }}" required>
                                    <span class="form-control-label">The price must be in the format 9.99,use a dot as a separator (9.99)</span>
                                    @if($errors->has('price_usd'))
                                        <span class="text-danger">*{{ $errors->first('price_usd') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group @if($errors->has('price_eur')) has-danger @endif">
                                    <label for="price_eur">Class price in EUR</label>
                                    <input id="price_eur" class="form-control" placeholder="EUR price"
                                           name="price_eur"
                                           value="{{ old('price_eur') ?? $class->price_eur }}" required>
                                    <span class="form-control-label">The price must be in the format 9.99,use a dot as a separator (9.99)</span>
                                    @if($errors->has('price_eur'))
                                        <span class="text-danger">*{{ $errors->first('price_eur') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group @if($errors->has('price_sar')) has-danger @endif">
                                    <label for="price_sar">Class price in SAR</label>
                                    <input id="price_sar" class="form-control" placeholder="SAR price"
                                           name="price_sar"
                                           value="{{ old('price_sar') ?? $class->price_sar }}" required>
                                    <span class="form-control-label">The price must be in the format 9.99,use a dot as a separator (9.99)</span>
                                    @if($errors->has('price_sar'))
                                        <span class="text-danger">*{{ $errors->first('price_sar') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group @if($errors->has('price_omr')) has-danger @endif">
                                    <label for="price_omr">Class price in OMR</label>
                                    <input id="price_omr" class="form-control" placeholder="OMR price"
                                           name="price_omr"
                                           value="{{ old('price_omr') ?? $class->price_omr }}" required>
                                    <span class="form-control-label">The price must be in the format 9.99,use a dot as a separator (9.99)</span>
                                    @if($errors->has('price_omr'))
                                        <span class="text-danger">*{{ $errors->first('price_omr') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="class_location">Location</label>
                                <select class="selectpicker form-control"
                                        data-toggle="select" multiple data-placeholder="Location" required
                                        multiple id="class_location" name="class_location[]">
                                    @foreach($classLocation as $location)
                                        <option @if(in_array($location->id, $selectedLocations, true)) selected
                                                @endif value="{{ $location->id }}">{{ $location->location }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger d-none error-span error-class_location"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group @if($errors->has('description')) has-danger @endif">
                                    <label for="description">Description</label>
                                    <textarea id="description" class="form-control" placeholder="Description"
                                              name="description"
                                              rows="4" cols="50"
                                              required>{{ old('description') ?? $class->description }}</textarea>
                                    @if($errors->has('description'))
                                        <span class="text-danger">*{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group @if($errors->has('map_location')) has-danger @endif">
                                    <label for="map_location">Map location</label>
                                    <textarea id="map_location" class="form-control" placeholder="Map location"
                                              name="map_location"
                                              rows="4" cols="50"
                                    >{{ old('map_location') ?? $class->map_location }}</textarea>
                                    @if($errors->has('map_location'))
                                        <span class="text-danger">*{{ $errors->first('map_location') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div
                                class="form-group col-md-6 error-danger error-danger-image_desktop error-danger-media_desktop_id">
                                <label class="asterisk"> Main Image</label>
                                @include('partials.media.form', [
                                        'mediaUrl' => $class->desktopImage()->getUrl(),
                                        'inputName' => "image_desktop",
                                        'mediaName' => "media_desktop_id",
                                        'deleteName' => "desktop_deleted",
                                        'exists' => true,
                                        'resource' => $class,
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
                                <label class="asterisk"> Second Image</label>
                                @include('partials.media.form', [
                                        'mediaUrl' => $class->mobileImage()->getUrl(),
                                        'inputName' => "image_mobile",
                                        'mediaName' => "media_mobile_id",
                                        'deleteName' => "mobile_deleted",
                                        'exists' => true,
                                        'resource' => $class,
                                        'mediaModal' => 'media-modal-mobile'
                                   ])
                                <p class="form-control-label">Required image: landscape <span
                                        class="image-desktop-portrait"></span>
                                </p>
                                <span
                                    class="text-danger d-none error-span error-image_mobile error-media_mobile_id"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 ml-auto mr-auto text-right">
                                <a href="{{ route('classes.index') }}" class="btn"> Cancel </a>
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
