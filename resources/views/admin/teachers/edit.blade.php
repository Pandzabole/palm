@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-left"> Edit Teacher </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('teachers.update', $teacher->id)}}"
                          enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-row">
                            <div class="form-group col-md-6 @if($errors->has('name')) has-danger @endif">
                                <label for="name">Name and second name</label>
                                <input id="name" class="form-control" placeholder="Name and second name"
                                       name="name"
                                       value="{{ old('name') ?? $teacher->name }}" required>
                                @if($errors->has('name'))
                                    <span class="text-danger">*{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="col-lg-6 pl-3">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select class="form-control"
                                            id="gender"
                                            name="gender">
                                        @foreach($genders as $gender)
                                            {{$gender}}
                                            <option @if(in_array($teacher->id, $genders)) selected
                                                    @endif value="{{ $gender }}">{{ $gender}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger d-none error-span error-gender"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">

                            <div class="form-group col-md-6 @if($errors->has('email')) has-danger @endif">
                                <label for="email">Email</label>
                                <input id="email" class="form-control" placeholder="Email"
                                       name="email"
                                       value="{{ old('email') ?? $teacher->email }}" required>
                                @if($errors->has('email'))
                                    <span class="text-danger">*{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 @if($errors->has('phone')) has-danger @endif">
                                <label for="phone">Phone</label>
                                <input id="phone" class="form-control" placeholder="Name and second name"
                                       name="phone"
                                       value="{{ old('phone') ?? $teacher->phone }}" required>
                                @if($errors->has('email'))
                                    <span class="text-danger">*{{ $errors->first('phone') }}</span>
                                @endif
                            </div>


                            <div class="form-group col-md-6 @if($errors->has('url')) has-danger @endif">
                                <label for="url">Social link</label>
                                <input id="url" class="form-control" placeholder="Social link"
                                       name="url"
                                       value="{{ old('url') ?? $teacher->url }}">
                                @if($errors->has('url'))
                                    <span class="text-danger">*{{ $errors->first('url') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="asterisk">Image</label>
                                @include('partials.media.form', [
                                    'inputName' => 'image',
                                    'exists' => true,
                                    'mediaId'=> optional($teacher->firstMedia())->id,
                                    'mediaUrl' => $teacher->firstMediaUrl(),
                                    'mediaModal' => 'media-modal-image'
                                ])
                                <p class="form-control-label">
                                    Recommended dimensions: 750x1686px
                                </p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col ml-auto mr-auto text-right">
                                <a href="{{ route('teachers.index') }}" class="btn"> Cancel </a>
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
