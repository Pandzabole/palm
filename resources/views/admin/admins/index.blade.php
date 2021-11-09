@extends('layouts.app')

@section('partials.sidenav')
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Admins </h4>
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('admins.create') }}" class="btn btn-primary float-right">Create</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive py-4">
                    <table class="table" id="data-table">
                        <thead class="text-primary pb-5 pt-5">
                        <tr>
                            <th> Name</th>
                            <th> Admin privileges </th>
                            <th class="text-right"> Action</th>
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
                ajax: '{!! route('admins.data') !!}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'admin_privileges', name: 'admin'},
                    {data: 'actions', name: 'actions', sortable: false, searchable: false, className: 'text-right'},
                ]
            });
        });
    </script>
@endsection
