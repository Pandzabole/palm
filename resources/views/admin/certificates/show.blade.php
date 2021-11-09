@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title text-left">Certificate Details</h4>
                        </div>
                        <div class="col-6" style="text-align: right">
                            <a href="{{ route('certificates.edit', $certificate->id) }}"
                               class="btn btn-warning btn-fab btn-icon btn-round">
                                <i class="fa fa-edit"></i>
                            </a>
                            @include('partials.delete-with-confirmation', ['model' => $certificate, 'routeModelName' => 'certificates'])
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="">
                                        <table class="table table-borderless">
                                            <tbody>
                                            <tr>
                                                <th scope="row" width="30%"> Name</th>
                                                <td>{{$certificate->name}}</td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%">Image</th>
                                                <td>
                                                    <img class="thumbnail-show" alt=""
                                                         src="{{ asset( $certificate->firstMediaThumb()) }}">
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
