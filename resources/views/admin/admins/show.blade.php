@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title text-left">Admin Details</h4>
                        </div>
                        <div class="col-6" style="text-align: right">
                            <a href="{{ route('admins.edit', $admin->id) }}"
                               class="btn btn-warning btn-fab btn-icon btn-round">
                                <i class="fa fa-edit"></i>
                            </a>
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
                                                <td>{{$admin->name}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" width="30%"> Email</th>
                                                <td>{{$admin->email}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" width="30%"> Admins privileges</th>
                                                <td>{{$admin->role_name}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" width="30%"> Markets</th>
                                                <td>
                                                @foreach($admin->mainMarkets as $market)
                                                {{$market->name}},
                                                @endforeach
                                                </td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%"> Status</th>
                                                <td><img
                                                        src="@if($admin->status) {{ asset('img/checked.png') }} @else {{ asset('img/unchecked.png') }} @endif"
                                                        width="20px" alt="status"></td>
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
