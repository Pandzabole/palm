@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="row">
                    <div class="col">
                        <h3 class="mb-0 mt-5 ml-3">Class locations</h3>
                        <div class="col">
                            <a href="{{ route('class-location.create') }}" class="btn btn-primary float-right">Create</a>
                        </div>
                    </div>

                </div>
                <div class="table-responsive py-4">
                    <table class="table" id="data-table">
                        <thead class="text-primary pb-5 pt-5">
                        <tr>
                            <th>Location</th>
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
                ajax: '{!! route('class-location.data') !!}',
                order: [[0, 'desc']],
                columns: [
                    {data: 'location', name: 'location', sortable: true},
                    {data: 'actions', name: 'actions', sortable: false, searchable: false, className: 'text-right'},
                ]
            });
        });
    </script>
@endsection
