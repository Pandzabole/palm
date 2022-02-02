@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="row">
                    <div class="col">
                        <h3 class="mb-0 mt-5 ml-3">Sub categories</h3>
                        <div class="col">
                            <a href="{{ route('sub-categories.create') }}" class="btn btn-primary float-right">Create</a>
                        </div>
                    </div>

                </div>
                <div class="table-responsive py-4">
                    <table class="table" id="data-table">
                        <thead class="text-primary pb-5 pt-5">
                        <tr>
                            <th> Sub category</th>
                            <th> Main category</th>
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
                ajax: '{!! route('sub-categories.data') !!}',
                order: [[0, 'desc']],
                columns: [
                    {data: 'name', name: 'name', sortable: true},
                    {data: 'categories', name: 'categories', sortable: true},
                    {data: 'actions', name: 'actions', sortable: false, searchable: false, className: 'text-right'},
                ]
            });
        });
    </script>
@endsection
