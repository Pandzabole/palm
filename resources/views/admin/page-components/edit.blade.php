@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header @if($errors->has('components.*')) error-warning @endif">
                    <div class="row">
                        <div class="col-6">
                            @if($errors->has('components.*'))
                                <h4 class="card-title text-left components-title-error">Please check that all required
                                    fields are entered correctly</h4>
                            @endif
                            <h4 class="card-title text-left components-title">Edit page {{$pageSlug}}</h4>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{route('components.show', $pageSlug)}}"
                               class="btn btn-primary btn-icon">
                                <i class="fa fa-eye"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form id="page-components" method="POST" action="{{ route('components.update', $pageSlug) }}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @foreach($pageComponents as $component)
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4 class="card-title text-left">
                                                Section {{$component->primary_title}} {{$component->secondary_title}} </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <input type="hidden" name="components[{{ $component->id }}][id]"
                                               value="{{$component->id}}">
                                        @if($component->tag)
                                            <div class="col-6 form-group  @if($errors->has('tag')) has-danger @endif">
                                                <label for="tag">Tag</label>
                                                <input type="text" class="form-control" placeholder="Tag"
                                                       name="components[{{ $component->id }}][tag]"
                                                       value="{{ old('tag') ?? $component->tag }}" required>
                                                @if($errors->has('tag'))
                                                    <span class="text-danger">*{{ $errors->first('tag') }}</span>
                                                @endif
                                            </div>
                                        @endif
                                        @if($component->primary_title)
                                            <div
                                                class="col-6 form-group  @if($errors->has('primary_title')) has-danger @endif">
                                                <label for="primary_title">Primary title</label>
                                                <input type="text" class="form-control"
                                                       placeholder="Primary title"
                                                       name="components[{{ $component->id }}][primary_title]"
                                                       value="{{ old('primary_title') ?? $component->primary_title }}"
                                                       required>
                                                @if($errors->has('primary_title'))
                                                    <span
                                                        class="text-danger">*{{ $errors->first('primary_title') }}</span>
                                                @endif
                                            </div>
                                        @endif
                                        @if($component->secondary_title)
                                            <div
                                                class="col-6 form-group  @if($errors->has('secondary_title')) has-danger @endif">
                                                <label for="secondary_title">Secondary title</label>
                                                <input type="text" class="form-control"
                                                       placeholder="Secondary title"
                                                       name="components[{{ $component->id }}][secondary_title]"
                                                       value="{{ old('secondary_title') ?? $component->secondary_title }}"
                                                       required>
                                                @if($errors->has('secondary_title'))
                                                    <span
                                                        class="text-danger">*{{ $errors->first('secondary_title') }}</span>
                                                @endif
                                            </div>
                                        @endif
                                        @if($component->sub_title)
                                            <div
                                                class="col-6 form-group  @if($errors->has('sub_title')) has-danger @endif">
                                                <label for="sub_title">Sub title</label>
                                                <input type="text" class="form-control"
                                                       placeholder="Sub title"
                                                       name="components[{{ $component->id }}][sub_title]"
                                                       value="{{ old('sub_title') ?? $component->sub_title }}"
                                                       required>
                                                @if($errors->has('sub_title'))
                                                    <span
                                                        class="text-danger">*{{ $errors->first('sub_title') }}</span>
                                                @endif
                                            </div>
                                        @endif
                                        @if($component->isCtaTypeExternal())
                                            <div class="col-6 form-group  @if($errors->has('url')) has-danger @endif">
                                                <label for="url">Button url</label>
                                                <input type="url" class="form-control" placeholder="Button url"
                                                       name="components[{{ $component->id }}][url]"
                                                       value="{{ old('url') ?? $component->url }}">
                                                @if($errors->has('url'))
                                                    <span class="text-danger">*{{ $errors->first('url') }}</span>
                                                @endif
                                            </div>
                                        @endif
                                        @if($component->cta || $component->isCtaTypeExternal())
                                            <div class="col-6 form-group  @if($errors->has('cta')) has-danger @endif">
                                                <label for="cta">Button text</label>
                                                <input type="text" class="form-control" placeholder="Button text"
                                                       name="components[{{ $component->id }}][cta]"
                                                       value="{{ old('cta') ?? $component->cta }}"
                                                       @if(!$component->isCtaTypeExternal()) required @endif>
                                                @if($errors->has('cta'))
                                                    <span class="text-danger">*{{ $errors->first('cta') }}</span>
                                                @endif
                                            </div>
                                        @endif
                                        @if($component->description)
                                            <div
                                                class="col form-group @if($errors->has('description')) has-danger @endif">
                                                <label for="description">Description</label>
                                                <textarea name="components[{{ $component->id }}][description]"
                                                          cols="30" rows="10"
                                                          class="form-control summernote"
                                                          required>{{ old('description') ?? $component->description }}</textarea>
                                                @if($errors->has('description'))
                                                    <span
                                                        class="text-danger">*{{ $errors->first('description') }}</span>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        @if(method_exists($component, 'media'))
                                            @if($image = $component->desktopImage())
                                                <div
                                                    class="col-6 form-group @if($errors->has('components.' . $component->id )) has-danger @endif">
                                                    <label class="asterisk"> Image Desktop</label>
                                                    @include('partials.media.form', [
                                                            'mediaUrl' => optional($image)->getUrl(),
                                                            'inputName' => "components[". $component->id ."][image_desktop]",
                                                            'mediaName' => "components[". $component->id ."][media_desktop_id]",
                                                            'deleteName' => "components[". $component->id ."][desktop_deleted]",
                                                            'exists' => true,
                                                            'resource' => $component,
                                                            'mediaModal' => 'media-modal-desktop'
                                                       ])
                                                    @if(data_get($component->config_image_desktop, 'required'))
                                                        <p class="form-control-label">
                                                            Required image: landscape
                                                            <span class="image-desktop-portrait"></span>
                                                        </p>
                                                    @endif
                                                    @if($recommended = data_get($component->config_image_desktop, 'recommended'))
                                                        <div class="form-control-label">
                                                            Recommended dimensions: {{ $recommended }}
                                                        </div>
                                                    @endif
                                                    @if($errors->has('components.' . $component->id ))
                                                        <span
                                                            class="text-danger">*{{ $errors->first('components.' . $component->id ) }}</span>
                                                    @endif
                                                </div>
                                            @endif
                                            @if($component->mobileImage())
                                                <div
                                                    class="col-6 form-group @if($errors->has('components.' . $component->id )) has-danger @endif">
                                                    <label class="asterisk"> Image Mobile</label>
                                                    @include('partials.media.form', [
                                                            'mediaUrl' => optional($component->mobileImage())->getUrl(),
                                                            'inputName' => "components[". $component->id ."][image_mobile]",
                                                            'mediaName' => "components[". $component->id ."][media_mobile_id]",
                                                            'deleteName' => "components[". $component->id ."][mobile_deleted]",
                                                            'exists' => true,
                                                            'resource' => $component,
                                                            'mediaModal' => 'media-modal-mobile'
                                                       ])
                                                    @if(data_get($component->config_image_mobile, 'required'))
                                                        <p class="form-control-label">
                                                            Required image: portrait
                                                            <span class="image-mobile-portrait"></span>
                                                        </p>
                                                    @endif
                                                    @if($recommended = data_get($component->config_image_mobile, 'recommended'))
                                                        <div class="form-control-label">
                                                            Recommended dimensions: {{ $recommended }}
                                                        </div>
                                                    @endif
                                                    @if($errors->has('components.' . $component->id ))
                                                        <span
                                                            class="text-danger">* {{ $errors->first('components.' . $component->id ) }}</span>
                                                    @endif
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-12 ml-auto mr-auto text-right">
                                    <a href="{{ route('components.show', $pageSlug) }}" class="btn"> Cancel </a>
                                    <button type="submit" class="btn btn-primary"> Update Components
                                    </button>
                                </div>
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
