@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="row">
                    <div class="col">
                        <h3 class="mb-0 mt-5 ml-3">Markets</h3>
                    </div>
                </div>
                <div class="table-responsive py-4">
                    <table class="table" id="data-table">
                        <thead class="text-primary pb-5 pt-5">
                        <tr>
                            <th class="text-center"> Position</th>
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
@endsection

@section('js-links')
    @parent

    <script>
        $(function () {
            let dataTable = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('markets.data') !!}',
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
                    {data: 'name', name: 'name'},
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
                        url: "{!! route('markets.reorder') !!}",
                        success: function () {
                            dataTable.ajax.reload(null, false);
                            $('.publish-button').removeClass('d-none');
                            notifyIt('Markets reordered')
                        }
                    });
                }
            });
        });
    </script>
@endsection
