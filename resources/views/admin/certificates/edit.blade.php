@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('certificates.update', $certificate->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-left"> Edit Certificate </h4>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6 error-danger">
                                <div class="form-group  @if($errors->has('name')) has-danger @endif">
                                    <label for="name">Name</label>
                                    <input id="name" type="text" class="form-control" placeholder="Name" name="name"
                                           value="{{ old('name') ?? $certificate->name }}" required>
                                    @if($errors->has('name'))
                                        <span class="text-danger">*{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 pr-1">
                                <label class="asterisk">Image</label>
                                @include('partials.media.form', [
                                    'inputName' => 'image',
                                    'exists' => true,
                                    'mediaId'=> optional($certificate->firstMedia())->id,
                                    'mediaUrl' => $certificate->firstMediaUrl(),
                                    'mediaModal' => 'media-modal-image'
                                ])
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col ml-auto mr-auto text-right mt-4">
                                <a href="{{ route('certificates.index') }}" class="btn"> Cancel </a>
                                <button id="submit" type="submit" class="btn btn-primary"> Save Certificate</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@include('partials.media.media-modal', ['mediaModalId' => 'image'])

@section('js-links')
    @parent
    <script src="{{ asset('js/media-model.js') }}"></script>
@endsection
