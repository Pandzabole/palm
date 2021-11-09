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
                                            <h5 class="h3 mb-0">Contacts</h5>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card body -->
                                <div class="card-body">
                                    <!-- List group -->
                                    <ul class="list-group list-group-flush list my--3">
                                        @forelse($contacts as $contact)
                                            <li class="list-group-item px-0">
                                                <div class="row align-items-center">
                                                    <div class="col ml--2">
                                                        <h4 class="mb-0">
                                                            <a href="{{ route('contacts.show', $contact) }}">{{ $contact->name }}</a>
                                                        </h4>
                                                        <small>{{ $contact->created_at }}</small>
                                                    </div>
                                                    <div class="col-auto">
                                                        <a href="{{ route('contacts.show', $contact) }}"
                                                           class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                                    </div>
                                                </div>
                                            </li>
                                        @empty
                                            No contacts
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
                                            <h5 class="h3 mb-0">Latest News</h5>
                                        </div>
                                        <div class="col text-right">
                                            <a href="{{ route('news.create') }}" class="btn btn-sm btn-primary">
                                                Create
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card body -->
                                <div class="card-body">
                                    <!-- List group -->
                                    <ul class="list-group list-group-flush list my--3">
                                        @forelse($news as $new)
                                            <li class="list-group-item px-0">
                                                <div class="row align-items-center">
                                                    <div class="col ml--2">
                                                        <h4 class="mb-0">
                                                            <a href="{{ route('news.show', $new) }}">{{ $new->title }}</a>
                                                        </h4>
                                                        <small>{{ $new->created_at }}</small>
                                                    </div>
                                                    <div class="col-auto">
                                                        <a href="{{ route('news.show', $new) }}"
                                                           class="btn btn-sm btn-warning"><i class="fa fa-eye"></i></a>
                                                    </div>
                                                </div>
                                            </li>
                                        @empty
                                            No news
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
                                            <h5 class="h3 mb-0">Latest Activities</h5>
                                        </div>
                                        <div class="col text-right">
                                            <a href="{{ route('news.create') }}" class="btn btn-sm btn-primary">
                                                Create
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card body -->
                                <div class="card-body">
                                    <!-- List group -->
                                    <ul class="list-group list-group-flush list my--3">
                                        @forelse($activities as $activity)
                                            <li class="list-group-item px-0">
                                                <div class="row align-items-center">
                                                    <div class="col ml--2">
                                                        <h4 class="mb-0">
                                                            <a href="{{ route('activities.show', $activity) }}">{{ $activity->title }}</a>
                                                        </h4>
                                                        <small>{{ $activity->created_at }}</small>
                                                    </div>
                                                    <div class="col-auto">
                                                        <a href="{{ route('activities.show', $activity) }}"
                                                           class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                                    </div>
                                                </div>
                                            </li>
                                        @empty
                                            No activities
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
