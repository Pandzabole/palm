@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title text-left">Class details</h4>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route('class-reservation.edit', $classReservation->id) }}"
                               class="btn btn-warning btn-fab btn-icon btn-round">
                                <i class="fa fa-edit"></i>
                            </a>
                            @include('partials.delete-with-confirmation', ['model' => $classReservation, 'routeModelName' => 'class-reservation'])
                        </div>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                <tr class="border-bottom">
                                    <th scope="row" width="30%"> Client name</th>
                                    <td>{{ $classReservation->name }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th scope="row" width="30%"> Client email</th>
                                    <td>{{ $classReservation->email }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th scope="row" width="30%"> Client phone</th>
                                    <td>{{ $classReservation->phone }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th scope="row" width="60%"> Comment</th>
                                    <td class="component-description">{{ $classReservation->comment }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th scope="row" width="30%"> Class name</th>
                                    <td>{{ $classReservation->classe->name}}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th scope="row" width="30%"> Class teacher</th>
                                    <td>{{ $classReservation->teacher->name}}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th scope="row" width="30%"> Teacher email</th>
                                    <td>{{ $classReservation->teacher->email}}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th scope="row" width="30%"> Teacher phone</th>
                                    <td>{{ $classReservation->teacher->phone}}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th scope="row" width="30%"> Country</th>
                                    <td>{{$classReservation->country}}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th scope="row" width="30%"> City</th>
                                    <td>{{$classReservation->city}}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th scope="row" width="30%"> Is read information?</th>
                                    <th scope="row" width="30%"> <img src="{{ asset($classReservation->read_reservation ? 'img/checked.png' : 'img/unchecked.png') }}" class="pt-2" width="20px" alt="read"></td>
                                    @if($classReservation->read_reservation == false)
                                        <th scope="row">
                                            <a href="{{ route('class.read', $classReservation->id) }}"
                                               class="btn btn-sm btn-warning">Change</a></th>
                                    @endif
                                </tr>
                                <tr class="border-bottom">
                                    <th scope="row" width="30%"> Is reply to client?</th>
                                    <th scope="row" width="30%"> <img src="{{ asset($classReservation->reply_client ? 'img/checked.png' : 'img/unchecked.png') }}" class="pt-2" width="20px" alt="read"></td>
                                    @if($classReservation->reply_client == false)
                                        <th scope="row">
                                            <a href="{{ route('class.reply', $classReservation->id) }}"
                                               class="btn btn-sm btn-warning">Change</a></th>
                                    @endif
                                </tr>
                                <tr class="border-bottom">
                                    <th scope="row" width="30%"> Is class payed?</th>
                                    <th scope="row" width="30%"> <img src="{{ asset($classReservation->is_payed ? 'img/checked.png' : 'img/unchecked.png') }}" class="pt-2" width="20px" alt="read"></td>
                                </tr>
                                <tr class="border-bottom">
                                    <th scope="row" width="30%"> Class price</th>
                                    <td>{{ $classReservation->amount }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th scope="row" width="30%"> Class location</th>
                                    <td>
                                        @foreach($classReservation->classe->locations as $location)
                                            {{ $location->location }},
                                        @endforeach
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
@endsection

@section('script-links')
    @parent
    <script src="{{ asset('js/delete-confirmation-modal.js') }}"></script>
@endsection
