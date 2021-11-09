@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Activity Categories </h4>
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('activity-categories.create') }}"
                               class="btn btn-primary float-right">Create</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="data-table" class="table">
                            <thead class="text-primary">
                            <tr>
                                <th> Name</th>
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
    </div>
@endsection

@section('js-links')
    @parent

    <script>
        $(function () {
            $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('activity-categories.data') !!}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'actions', name: 'actions', sortable: false, searchable: false, className: 'text-right'},
                ]
            });
        });
    </script>
@endsection
