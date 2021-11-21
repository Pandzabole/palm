@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Teachers </h4>
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('teachers.create') }}" class="btn btn-primary float-right">Create</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive py-4">
                    <table class="table" id="data-table">
                        <thead class="text-primary pb-5 pt-5">
                        <tr>
                            <th> Name </th>
                            <th> Gender </th>
                            <th> Email </th>
                            <th class="text-right"> Action </th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-links')
    @parent

    <script>
        $(function () {
            $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('teachers.data') !!}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'gender', name: 'gender'},
                    {data: 'email', name: 'email'},
                    {data: 'actions', name: 'actions', sortable: false, searchable: false, className: 'text-right'},
                ]
            });
        });
    </script>
@endsection
