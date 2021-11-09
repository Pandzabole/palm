@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-left"> Create Certificate </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('certificates.store')}}" enctype="multipart/form-data">
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

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 error-danger">
                                <label class="form-control-label" for="image">Image</label>
                                @include('partials.media.form', ['inputName' => 'image', 'mediaName' => 'media_id',  'mediaModal' => 'media-modal-image', 'exists' => false])
                                <span class="text-danger d-none error-span"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 ml-auto mr-auto text-right">
                                <a href="{{ route('certificates.index') }}" class="btn"> Cancel </a>
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

    <script src="{{ asset('js/media-model.js') }}"></script>

@endsection

