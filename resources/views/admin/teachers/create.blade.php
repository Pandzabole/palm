@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-left"> Create Teacher </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('teachers.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6 @if($errors->has('name')) has-danger @endif">
                                <label for="name">Name and second name</label>
                                <input id="name" class="form-control" placeholder="Name"
                                       name="name"
                                       value="{{ old('name')}}" required>
                                @if($errors->has('name'))
                                    <span class="text-danger">*{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 @if($errors->has('gender')) has-danger @endif">
                                    <label for="gender">Gender</label>
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
                                <label for="email">Email</label>
                                <input id="email" class="form-control" placeholder="Email"
                                       name="email"
                                       value="{{ old('email')}}" required>
                                @if($errors->has('email'))
                                    <span class="text-danger">*{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 @if($errors->has('phone')) has-danger @endif">
                                <label for="phone">Phone</label>
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
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 form-group @if($errors->has('testimonials_first')) has-danger @endif">
                                <label for="testimonials_first">Testimonials first</label>
                                <textarea name="testimonials_first"
                                          cols="30" rows="3"
                                          class="form-control summernote"
                                          required>{{ old('testimonials_first') }}</textarea>
                                @if($errors->has('testimonials_first'))
                                    <span class="text-danger">*{{ $errors->first('testimonials_first') }}</span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group @if($errors->has('testimonials_second')) has-danger @endif">
                                <label for="testimonials_second">Testimonials second</label>
                                <textarea name="testimonials_second"
                                          cols="30" rows="3"
                                          class="form-control summernote"
                                          required>{{ old('testimonials_second') }}</textarea>
                                @if($errors->has('testimonials_second'))
                                    <span class="text-danger">*{{ $errors->first('testimonials_second') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col form-group @if($errors->has('description')) has-danger @endif">
                                <label for="description">Description</label>
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
                                <label class="asterisk">Image</label>
                                @include('partials.media.form', ['inputName' => 'image', 'exists' => false, 'mediaModal' => 'media-modal-image'])
                                <p class="form-control-label">
                                    Recommended dimensions: 750x1686px
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
