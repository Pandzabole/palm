@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title text-left">Contacts Details</h4>
                        </div>
                        <div class="col-6" style="text-align: right">
                            <form method="POST" action="{{route('contacts.destroy', $contact->id) }}" class="d-none gl-delete-form">
                                @csrf
                                {{ method_field('DELETE') }}
                            </form>
                            <button type="submit" form="delete" class="btn btn-danger btn-icon gl-delete-btn">
                                <i class="fa fa-trash"></i>
                            </button>
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
                                                <td>{{$contact->name}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" width="30%"> Email</th>
                                                <td>{{$contact->email}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" width="30%"> Description</th>
                                                <td class="component-description">{{$contact->description}}</td>
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
