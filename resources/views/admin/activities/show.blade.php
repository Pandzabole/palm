@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title text-left">Activity details</h4>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route('activities.edit', $activity->id) }}"
                               class="btn btn-warning btn-fab btn-icon btn-round">
                                <i class="fa fa-edit"></i>
                            </a>
                            @include('partials.delete-with-confirmation', ['model' => $activity, 'routeModelName' => 'activities'])
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
                                                <td>{{ $activity->created_at }}</td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%"> Title</th>
                                                <td>{{ $activity->title }}</td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%"> Summary</th>
                                                <td class="component-description">{{ $activity->description }}</td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%"> Categories</th>
                                                <td>{{ $activity->categories->implode('name', ', ') }}</td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%"> Image</th>
                                                <td>
                                                    <img class="thumbnail-show" alt=""
                                                         src="{{ asset( $activity->firstMediaThumb()) }}">
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
    @include('vendor.content.content-table', ['resource' => $activity])
@endsection

@include('partials.media.media-modal')
