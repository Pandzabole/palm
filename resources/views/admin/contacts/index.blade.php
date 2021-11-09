@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="row">
                    <div class="col">
                        <h3 class="mb-0 mt-5 ml-3">Contacts</h3>
                    </div>
                </div>
                <div class="table-responsive py-4">
                    <table class="table" id="data-table">
                        <thead class="text-primary pb-5 pt-5">
                        <tr>
                            <th> Date</th>
                            <th> Name</th>
                            <th> Email</th>
                            <th> Description</th>
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
                ajax: '{!! route('contacts.data') !!}',
                order: [[0, 'desc']],
                columns: [
                    {data: 'created_at', name: 'created_at'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'description', name: 'description'},
                    {data: 'actions', name: 'actions', sortable: false, searchable: false, className: 'text-right'},
                ]
            });
        });
    </script>
@endsection
