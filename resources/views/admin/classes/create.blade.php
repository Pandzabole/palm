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
                                <label for="name">Class title</label>
                                <input id="name" class="form-control" placeholder="Name"
                                       name="name"
                                       value="{{ old('name')}}" required>
                                @if($errors->has('name'))
                                    <span class="text-danger">*{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 @if($errors->has('class_category_id')) has-danger @endif">
                                <label for="categories">Main categories</label>
                                <select class="form-control category-search" id="classCategory"
                                        data-toggle="select" data-placeholder="Filter by categories"
                                        name="class_category_id">
                                    <option value="0">All categories</option>
                                    @foreach($classCategory as $name => $id)
                                        <option @if(old('class_category_id') == $name) selected @endif
                                        value="{{ $name }}">{{ $id }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('class_category_id'))
                                    <span class="text-danger">*{{ $errors->first('class_category_id') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div
                                class="form-group col-md-6 @if($errors->has('class_sub_category_id')) has-danger @endif">
                                <label for="classSubCategory">Sub categories</label>
                                <select class="form-control category-search" id="classSubCategory"
                                        data-toggle="select" data-placeholder="Filter by sub categories"
                                        name="class_sub_category_id">
                                    <option value="0">All sub categories</option>
                                    @foreach($classSubCategory as $name => $id)
                                        <option @if(old('class_sub_category_id') == $name) selected @endif
                                        value="{{ $name }}">{{ $id }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('class_sub_category_id'))
                                    <span class="text-danger">*{{ $errors->first('class_sub_category_id') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 @if($errors->has('teacher_id')) has-danger @endif">
                                <label for="teacher">Teacher</label>
                                <select class="form-control category-search" id="teacher"
                                        data-toggle="select" data-placeholder="Filter by teacher"
                                        name="teacher_id">
                                    <option value="0">All teachers</option>
                                    @foreach($teacher as $name => $id)
                                        <option @if(old('teacher_id') == $name) selected @endif
                                        value="{{ $name }}">{{ $id }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('teacher_id'))
                                    <span class="text-danger">*{{ $errors->first('teacher_id') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 @if($errors->has('price_usd')) has-danger @endif">
                                <label for="price_usd">Class price in USD</label>
                                <input id="price_usd" class="form-control" placeholder="USD price"
                                       name="price_usd"
                                       value="{{ old('price_usd')}}" required>
                                <span class="form-control-label">The price must be in the format 9.99,use a dot as a separator (9.99)</span>
                                @if($errors->has('price_usd'))
                                    <span class="text-danger">*{{ $errors->first('price_usd') }}</span>
                                @endif
                            </div>

                            <div class="form-group col-md-6 @if($errors->has('price_eur')) has-danger @endif">
                                <label for="price_eur">Class price in EUR</label>
                                <input id="price_eur" class="form-control" placeholder="EUR price"
                                       name="price_eur"
                                       value="{{ old('price_eur')}}" required>
                                <span class="form-control-label">The price must be in the format 9.99,use a dot as a separator (9.99)</span>
                                @if($errors->has('price_eur'))
                                    <span class="text-danger">*{{ $errors->first('price_eur') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 @if($errors->has('price_sar')) has-danger @endif">
                                <label for="price_sar">Class price in SAR</label>
                                <input id="price_sar" class="form-control" placeholder="SAR price"
                                       name="price_sar"
                                       value="{{ old('price_sar')}}" required>
                                <span class="form-control-label">The price must be in the format 9.99,use a dot as a separator (9.99)</span>
                                @if($errors->has('price_sar'))
                                    <span class="text-danger">*{{ $errors->first('price_sar') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 @if($errors->has('price_omr')) has-danger @endif">
                                <label for="price_omr">Class price in OMR</label>
                                <input id="price_omr" class="form-control" placeholder="OMR price"
                                       name="price_omr"
                                       value="{{ old('price_omr')}}" required>
                                <span class="form-control-label">The price must be in the format 9.99,use a dot as a separator (9.99)</span>
                                @if($errors->has('price_omr'))
                                    <span class="text-danger">*{{ $errors->first('price_omr') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row discount-price p-1 mb-3">
                            <div class="form-check col-md-2 mb-3">
                                <div class="form-check-label mb-3 mt-2">Popular class</div>
                                <input type="checkbox" name="popular" class="switch-input"
                                       value="1" {{ old('popular') ? 'checked="checked"' : '' }}/>
                                <label class="form-check-label" for="popular" style="color: #c45151">Popular
                                    class</label>

                            </div>
                            <div class="form-check col-md-2 mb-3">
                                <div class="form-check-label mb-3 mt-2">Show on home page</div>
                                <input type="checkbox" name="highlighted" class="switch-input"
                                       value="1" {{ old('highlighted') ? 'checked="checked"' : '' }}/>
                                <label class="form-check-label" for="highlighted" style="color: #c45151">Show on home page</label>

                            </div>
                            <div class="form-check col-md-2 mb-3">
                                <div class="form-check-label mb-3 mt-2">Discounted class</div>
                                <input type="checkbox" name="discount" class="switch-input"
                                       value="1" {{ old('discount') ? 'checked="checked"' : '' }}/>
                                <label class="form-check-label" for="discount" style="color: #c45151">Discounted
                                    class</label>

                            </div>

                            <div class="form-group col-md-6 pt-2 @if($errors->has('discount_percentage')) has-danger @endif">
                                <label for="discount_percentage">Class discount</label>
                                <input id="discount_percentage" class="form-control" placeholder="Class discount"
                                       name="discount_percentage"
                                       type="number"
                                       value="{{ old('discount_percentage')}}">
                                <span class="form-control-label">The discount must be in the format 20.00 use a dot as a separator (20.00)</span>
                                @if($errors->has('discount_percentage'))
                                    <span class="text-danger">*{{ $errors->first('discount_percentage') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 @if($errors->has('class_location')) has-danger @endif">
                                <label for="classLocation" class="asterisk">Class Location</label>
                                <select class="form-control category-search" id="classLocation"
                                        data-toggle="select" multiple data-placeholder="Class Location" required
                                        name="class_location[]">
                                    @foreach($classLocation as $id => $name)
                                        <option
                                            value="{{ $id }}" {{ (collect(old('class_location'))->contains($id)) ? 'selected':'' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if($errors->has('class_location'))
                                    <span class="text-danger">*{{ $errors->first('class_location') }}</span>
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
                                          name="map_location" rows="4" cols="50"
                                >{{ old('map_location') }}</textarea>
                                @if($errors->has('map_location'))
                                    <span class="text-danger">*{{ $errors->first('map_location') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 error-danger">
                                <label class="form-control-label" for="image">Main Image</label>
                                @include('partials.media.form', ['inputName' => 'image_desktop', 'mediaName' => 'media_desktop_id',  'mediaModal' => 'media-modal-desktop', 'exists' => false])
                                <p class="form-control-label">Required image: landscape <span
                                        class="image-desktop-portrait"></span>
                                </p>
                                <span class="text-danger d-none error-span"></span>
                            </div>
                            <div class="form-group col-md-6 error-danger">
                                <label class="form-control-label" for="image">Second Image</label>
                                @include('partials.media.form', ['inputName' => 'image_mobile', 'mediaName' => 'media_mobile_id', 'mediaModal' => 'media-modal-mobile', 'exists' => false])
                                <p class="form-control-label">Required image: landscape <span
                                        class="image-desktop-portrait"></span>
                                </p>
                                <span class="text-danger d-none error-span"></span>
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

@include('partials.media.media-modal', ['mediaModalId' => 'mobile', 'media' => $mediaMobile])
@include('partials.media.media-modal', ['mediaModalId' => 'desktop', 'media' => $mediaDesktop])

@section('js-links')
    @parent

    <script src="{{ asset('js/media-model.js') }}"></script>

@endsection
