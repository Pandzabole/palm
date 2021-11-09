@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header bg-transparent">
                    <div class="row">
                        <div class="col">
                            <h3 class="mb-0">Sliders</h3>
                        </div>
                        <div class="col">
                            <a href="{{ route('sliders.create') }}" class="float-right btn btn-primary" type="button">
                                Create
                            </a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive py-4">
                    <table class="table table-flush" id="data-table">
                        <thead class="text-primary">
                        <tr>
                            <th>Page</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-links')
    @parent
    <script src="{{ asset('js/delete-confirmation-modal.js') }}"></script>

    <script>
        $(function () {
            $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('sliders.data') !!}',
                columns: [
                    {data: 'pages', name: 'pages'},
                    {data: 'actions', name: 'actions', sortable: false, searchable: false, className: 'text-right'},
                ]
            });
        });
    </script>
@endsection
