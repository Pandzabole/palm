@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class=" col ">
            <div class="card">
                <div class="card-header bg-transparent">
                    <h3 class="mb-0">Dashboard</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-4">
                            <!-- Members list group card -->
                            <div class="card">
                                <!-- Card header -->
                                <div class="card-header">
                                    <!-- Title -->
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="h3 mb-0">Latest reservations</h5>
                                        </div>
                                        <div class="col text-right">
                                            <a href="{{ route('class-reservation.index') }}"
                                               class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card body -->
                                <div class="card-body">
                                    <!-- List group -->
                                    <ul class="list-group list-group-flush list my--3">
                                        @forelse($reservationClass as $reservation)
                                            <li class="list-group-item px-0">
                                                <div class="row align-items-center">
                                                    <div class="col ml--2">
                                                        <h4 class="mb-0">
                                                            <a href="{{ route('class-reservation.show', $reservation) }}">{{ $reservation->name }}</a>
                                                        </h4>
                                                        <h4 class="mb-0">
                                                            <a href="{{ route('class-reservation.show', $reservation) }}">{{ $reservation->email }}</a>
                                                        </h4>
                                                        <small>{{ $reservation->created_at->format('Y/m/d') }}</small>
                                                    </div>
                                                    <div class="col-auto">
                                                        <a href="{{ route('class-reservation.show', $reservation) }}"
                                                           class="btn btn-sm btn-warning"><i class="fa fa-eye"></i></a>
                                                    </div>
                                                </div>
                                            </li>
                                        @empty
                                            No reservations
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <!-- Members list group card -->
                            <div class="card">
                                <!-- Card header -->
                                <div class="card-header">
                                    <!-- Title -->
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="h3 mb-0 d-inline">Unread reservations</h5>
                                            @if($reservationClassUnread->count() > 0)
                                                <button type="button" class="btn btn-danger btn-circle btn-sm d-inline count-class-btn">{{$reservationClassUnread->count()}}</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- Card body -->
                                <div class="card-body">
                                    <!-- List group -->
                                    <ul class="list-group list-group-flush list my--3">
                                        @forelse($reservationClassUnread as $reservation)
                                            <li class="list-group-item px-0">
                                                <div class="row align-items-center">
                                                    <div class="col ml--2">
                                                        <h4 class="mb-0">
                                                            <a href="{{ route('class-reservation.show', $reservation) }}">{{ $reservation->name }}</a>
                                                        </h4>
                                                        <h4 class="mb-0">
                                                            <a href="{{ route('class-reservation.show', $reservation) }}">{{ $reservation->email }}</a>
                                                        </h4>
                                                        <small>{{ $reservation->created_at->format('Y/m/d') }}</small>
                                                    </div>
                                                    <div class="col-auto">
                                                        <a href="{{ route('class-reservation.show', $reservation) }}"
                                                           class="btn btn-sm btn-warning"><i class="fa fa-eye"></i></a>
                                                    </div>
                                                </div>
                                            </li>
                                        @empty
                                            No unread reservations
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <!-- Members list group card -->
                            <div class="card">
                                <!-- Card header -->
                                <div class="card-header">
                                    <!-- Title -->
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="h3 mb-0 d-inline">No answered reservations</h5>
                                            @if($noAnsweredReservations->count() > 0)
                                                <button type="button" class="btn btn-danger btn-circle btn-sm d-inline count-class-btn">{{$noAnsweredReservations->count()}}</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- Card body -->
                                <div class="card-body">
                                    <!-- List group -->
                                    <ul class="list-group list-group-flush list my--3">
                                        @forelse($noAnsweredReservations as $reservation)
                                            <li class="list-group-item px-0">
                                                <div class="row align-items-center">
                                                    <div class="col ml--2">
                                                        <h4 class="mb-0">
                                                            <a href="{{ route('class-reservation.show', $reservation) }}">{{ $reservation->name }}</a>
                                                        </h4>
                                                        <h4 class="mb-0">
                                                            <a href="{{ route('class-reservation.show', $reservation) }}">{{ $reservation->email }}</a>
                                                        </h4>
                                                        <small>{{ $reservation->created_at->format('Y/m/d') }}</small>
                                                    </div>
                                                    <div class="col-auto">
                                                        <a href="{{ route('class-reservation.show', $reservation) }}"
                                                           class="btn btn-sm btn-warning"><i class="fa fa-eye"></i></a>
                                                    </div>
                                                </div>
                                            </li>
                                        @empty
                                            No not answered reservations
                                        @endforelse
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
