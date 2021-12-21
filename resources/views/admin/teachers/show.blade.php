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
                            <a href="{{ route('teachers.edit', $teacher->id) }}"
                               class="btn btn-warning btn-fab btn-icon btn-round">
                                <i class="fa fa-edit"></i>
                            </a>
                            @include('partials.delete-with-confirmation', ['model' => $teacher, 'routeModelName' => 'teachers'])
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
                                                <th scope="row" width="30%"> Name and second name</th>
                                                <td>{{ $teacher->name }}</td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%"> Gender</th>
                                                <td>{{ $teacher->gender->gender}}</td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%"> Email</th>
                                                <td>{{ $teacher->email }}</td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%"> Phone</th>
                                                <td>{{ $teacher->phone }}</td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%"> Social link</th>
                                                <td>{{ $teacher->url }}</td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%"> Teacher image</th>
                                                <td>
                                                    <img class="thumbnail-show" alt=""
                                                         src="{{ asset( $teacher->firstMediaThumb()) }}">
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
@endsection

@include('partials.media.media-modal')
