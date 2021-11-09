@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title text-left components-title">Page {{$pageSlug}}</h4>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{route('components.edit', $pageSlug)}}"
                               class="btn btn-warning btn-fab btn-icon btn-round">
                                <i class="fa fa-edit"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @foreach($pageComponents as $component)
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6">
                                        <h4 class="card-title text-left">
                                            Section {{$component->primary_title}} {{$component->secondary_title}} </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <table class="table table-borderless">
                                            <tbody>
                                            @if($component->tag)
                                                <tr class="border-bottom">
                                                    <th scope="row" width="20%">Tag</th>
                                                    <td>{{$component->tag}}</td>
                                                </tr>
                                            @endif
                                            @if($component->primary_title)
                                                <tr class="border-bottom">
                                                    <th scope="row" width="20%">Primary title</th>
                                                    <td>{{$component->primary_title}}</td>
                                                </tr>
                                            @endif
                                            @if($component->secondary_title)
                                                <tr class="border-bottom">
                                                    <th scope="row" width="20%">Secondary title</th>
                                                    <td>{{$component->secondary_title}}</td>
                                                </tr>
                                            @endif
                                            @if($component->sub_title)
                                                <tr class="border-bottom">
                                                    <th scope="row" width="20%">Sub title</th>
                                                    <td>{{$component->sub_title}}</td>
                                                </tr>
                                            @endif
                                            @if($component->description)
                                                <tr class="border-bottom">
                                                    <th scope="row" width="20%">Description</th>
                                                    <td class="component-description">{!! $component->description !!}</td>
                                                </tr>
                                            @endif

                                            @if($component->isCtaTypeExternal())
                                                <tr class="border-bottom">
                                                    <th scope="row" width="20%">Button url</th>
                                                    <td>{{$component->url}}</td>
                                                </tr>
                                            @endif
                                            @if($component->cta || $component->isCtaTypeExternal())
                                                <tr class="border-bottom">
                                                    <th scope="row" width="20%">Button text</th>
                                                    <td>{{$component->cta}}</td>
                                                </tr>
                                            @endif
                                            @if(method_exists($component, 'media'))
                                                @if($desktopImage = $component->desktopImage())
                                                    <tr class="border-bottom">
                                                        <th scope="row" width="20%"> Image Desktop</th>
                                                        <td>
                                                            <img class="thumbnail-show" alt=""
                                                                 src="{{ asset($desktopImage->getThumbUrl()) }}">
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if($mobileImage = $component->mobileImage())
                                                    <tr class="border-bottom">
                                                        <th scope="row" width="20%"> Image Mobile</th>
                                                        <td>
                                                            <img class="thumbnail-show" alt=""
                                                                 src="{{ asset($mobileImage->getThumbUrl()) }}">
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-links')
    @parent
    <script src="{{ asset('js/delete-confirmation-modal.js') }}"></script>
@endsection
