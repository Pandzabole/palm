@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title text-left">News details</h4>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route('news.edit', $news->id) }}"
                               class="btn btn-warning btn-fab btn-icon btn-round">
                                <i class="fa fa-edit"></i>
                            </a>
                            @include('partials.delete-with-confirmation', ['model' => $news, 'routeModelName' => 'news'])
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <tbody>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%"> Date</th>
                                                <td>{{ $news->created_at }}</td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%"> Title</th>
                                                <td>{{ $news->title }}</td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%"> Summary</th>
                                                <td class="component-description">{{ $news->description }}</td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%"> Categories</th>
                                                <td>{{ $news->categories->implode('name', ', ') }}</td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%"> Image</th>
                                                <td>
                                                    <img class="thumbnail-show" alt=""
                                                         src="{{ asset( $news->firstMediaThumb()) }}">
                                                </td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%">Highlighted</th>
                                                <td>
                                                    <img src="@if($news->highlighted) {{ asset('img/checked.png') }}
                                                    @else {{ asset('img/unchecked.png') }} @endif" width="20px">
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('vendor.content.content-table', ['resource' => $news])
@endsection

@include('partials.media.media-modal')
