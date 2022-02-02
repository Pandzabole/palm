@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-left"> Create Teacher </h4>
                    <h4 class="card-title text-left"> Fields with <span class="text-danger">*</span> are required </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('teachers.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6 @if($errors->has('name')) has-danger @endif">
                                <label for="name">Name and second name <span class="text-danger">*</span></label>
                                <input id="name" class="form-control" placeholder="Name"
                                       name="name"
                                       value="{{ old('name')}}" required>
                                @if($errors->has('name'))
                                    <span class="text-danger">*{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 @if($errors->has('gender')) has-danger @endif">
                                    <label for="gender">Gender <span class="text-danger">*</span></label>
                                    <select class="form-control category-search" id="gender"
                                            data-toggle="select" data-placeholder="Gender"
                                            name="gender_id">
                                        @foreach($genders as $gender)
                                            <option value="{{$gender->id}}">{{$gender->gender}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('gender'))
                                        <span class="text-danger">*{{ $errors->first('gender') }}</span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 @if($errors->has('email')) has-danger @endif">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input id="email" class="form-control" placeholder="Email"
                                       name="email"
                                       value="{{ old('email')}}" required>
                                @if($errors->has('email'))
                                    <span class="text-danger">*{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 @if($errors->has('phone')) has-danger @endif">
                                <label for="phone">Phone <span class="text-danger">*</span></label>
                                <input id="phone" class="form-control" placeholder="Phone"
                                       name="phone"
                                       value="{{ old('phone')}}" required>
                                @if($errors->has('phone'))
                                    <span class="text-danger">*{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 @if($errors->has('url')) has-danger @endif">
                                <label for="url">Social link</label>
                                <input id="url" class="form-control" placeholder="Social link"
                                       name="url"
                                       value="{{ old('url')}}">
                                @if($errors->has('url'))
                                    <span class="text-danger">*{{ $errors->first('url') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 @if($errors->has('age')) has-danger @endif">
                                <label for="age">Age <span class="text-danger">*</span></label>
                                <input id="age" class="form-control" placeholder="Age"
                                       name="age"
                                       type="number"
                                       value="{{ old('age')}}" required>
                                @if($errors->has('age'))
                                    <span class="text-danger">*{{ $errors->first('age') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 @if($errors->has('nationality')) has-danger @endif">
                                <label for="nationality">Nationality <span class="text-danger">*</span></label>
                                <input id="nationality" class="form-control" placeholder="Nationality"
                                       name="nationality"
                                       required
                                       value="{{ old('nationality')}}">
                                @if($errors->has('nationality'))
                                    <span class="text-danger">*{{ $errors->first('nationality') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 @if($errors->has('address')) has-danger @endif">
                                <label for="address">Address <span class="text-danger">*</span></label>
                                <input id="address" class="form-control" placeholder="Address"
                                       name="address"
                                       value="{{ old('address')}}" required>
                                @if($errors->has('address'))
                                    <span class="text-danger">*{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 @if($errors->has('city')) has-danger @endif">
                                <label for="city">City <span class="text-danger">*</span></label>
                                <input id="city" class="form-control" placeholder="City"
                                       name="city"
                                       required
                                       value="{{ old('city')}}">
                                @if($errors->has('city'))
                                    <span class="text-danger">*{{ $errors->first('city') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 @if($errors->has('country')) has-danger @endif">
                                <label for="country">Country <span class="text-danger">*</span></label>
                                <input id="country" class="form-control" placeholder="Country"
                                       name="country"
                                       value="{{ old('country')}}" required>
                                @if($errors->has('country'))
                                    <span class="text-danger">*{{ $errors->first('country') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 form-group @if($errors->has('education')) has-danger @endif">
                                <label for="education">Education <span class="text-danger">*</span></label>
                                <textarea name="education"
                                          cols="30" rows="3"
                                          class="form-control summernote"
                                          required>{{ old('education') }}</textarea>
                                @if($errors->has('education'))
                                    <span class="text-danger">*{{ $errors->first('education') }}</span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group @if($errors->has('experience')) has-danger @endif">
                                <label for="experience">Experience <span class="text-danger">*</span></label>
                                <textarea name="experience"
                                          cols="30" rows="3"
                                          class="form-control summernote"
                                          required>{{ old('experience') }}</textarea>
                                @if($errors->has('experience'))
                                    <span class="text-danger">*{{ $errors->first('experience') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col form-group @if($errors->has('description')) has-danger @endif">
                                <label for="description">Description <span class="text-danger">*</span></label>
                                <textarea name="description"
                                          cols="30" rows="3"
                                          class="form-control summernote"
                                          required>{{ old('description') }}</textarea>
                                @if($errors->has('description'))
                                    <span class="text-danger">*{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="asterisk">Teache  Image <span class="text-danger">*</span></label>
                                @include('partials.media.form', ['inputName' => 'image', 'exists' => false, 'mediaModal' => 'media-modal-image'])
                                <p class="form-control-label">
                                    Recommended dimensions: 300x300px
                                </p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 ml-auto mr-auto text-right">
                                <a href="{{ route('teachers.index') }}" class="btn"> Cancel </a>
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
