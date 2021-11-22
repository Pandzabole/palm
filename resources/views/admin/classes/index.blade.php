@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Classes </h4>
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('classes.create') }}" class="btn btn-primary float-right">Create</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 pr-1">
                            <label for="categories">Filter by main category </label>
                            <select class="form-control category-search" id="categories"
                                    data-toggle="select" data-placeholder="Filter by categories"
                                    name="category">
                                <option value="0">All categories</option>
                                @foreach($categories as $name => $id)
                                    <option value="{{ $name }}">{{ $id }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="data-table" class="table">
                            <thead class="text-primary">
                            <tr>
                                <th> Position</th>
                                <th> Teacher </th>
                                <th> Categories</th>
                                <th> Sub category</th>
                                <th> Highlighted</th>
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
            let dataTable;
            fill_datatable();
            function fill_datatable(categoryId = null) {
                dataTable = $('#data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    ajax: {
                        url: '{{ route('classes.data')}}',
                        data: {
                            categoryId: categoryId
                        },
                        cache: false,
                    },
                    rowReorder: {
                        dataSrc: 'position',
                        update: false
                    },
                    columns: [
                        {
                            data: 'position',
                            name: 'position',
                            className: 'reorder',
                            render: function () {
                                return '<i class="fa fa-bars"></i>';
                            }
                        },
                        {data: 'name', name: 'name', searchable: true},
                        {data: 'class_category.name', name: 'category', searchable: true},
                        {data: 'class_sub_category.name', name: 'sub category', searchable: true},
                        {data: 'highlighted', name: 'highlighted'},
                        {data: 'actions', name: 'actions', sortable: false, searchable: false, className: 'text-right'},
                    ]
                });
                dataTable.on('row-reorder', function (e, diff) {
                    let reorders = [];

                    $.each(diff, function (index, changes) {
                        reorders.push({"old": changes.oldData, "new": changes.newData});
                    });

                    if (reorders.length > 0) {
                        $.ajax({
                            data: {
                                items: reorders,
                                _token: "{{ csrf_token() }}"
                            },
                            type: "POST",
                            url: "{!! route('classes.reorder') !!}",
                            success: function () {
                                dataTable.ajax.reload(null, false);
                            }
                        });
                    }
                });
            }
            $('#categories').on('change', function (e) {
                e.preventDefault();
                fill_datatable($(this).val());
            });
        });
    </script>
@endsection
