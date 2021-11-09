<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Content </h4>
                <div class="row">
                    <div class="col">
                        <div id="add-content" class="btn btn-light btn-round float-right" data-toggle="modal"
                             data-target="#contentCreateModal">Add Content
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="data-table" class="table">
                        <thead class="text-primary">
                        <tr>
                            <th> Order</th>
                            <th> Name</th>
                            <th> Type</th>
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

@include('vendor.content.modals.content-create', ['resource' => $resource])
@include('vendor.content.modals.content-update', ['resource' => $resource])
@include('vendor.content.modals.content-show')

@section('js-links')
    @parent
    <script src="{{ asset('js/plugins/bootstrap-selectpicker.js') }}"></script>
    <script>
        let body = $('body');
        let dataTable = $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('contents.data', ['containable' => get_class($resource), 'containable_id' => $resource->id]) !!}',
            rowReorder: {
                dataSrc: 'sort_order',
                update: false
            },
            columns: [
                {
                    data: 'sort_order',
                    name: 'sort_order',
                    className: 'reorder',
                    render: function () {
                        return '<i class="fa fa-bars"></i>';
                    }
                },
                {data: 'name', name: 'name'},
                {data: 'content_type_name', name: 'content_type_name'},
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
                    url: "{!! route('contents.reorder', ['containable' => get_class($resource), 'containable_id' => $resource->id]) !!}",
                    success: function () {
                        dataTable.ajax.reload(null, false);
                    }
                });
            }
        });

        let type = null;

        $('.content-types-select').on('change', function () {
            type = $('option:selected', this).attr("data-type");
            let content = $('#content-' + type);

            $('.content-types').addClass('d-none');
            content.removeClass('d-none');

            hideErrors();
        });

        $('#contentShowModal').on('hide.bs.modal', function () {
            $('video').get(0).pause();
        });

        $('#contentUpdateModal, #contentCreateModal').on('hide.bs.modal', function () {
            hideErrors();
        })

        $(body).on('click', '#submit-content', function () {
            let button = $(this);
            button.addClass('disabled');
            let containable = $('#containable-create').val();
            let containableId = $('#containable-id-create').val()
            let contentType = $('#content-types').val();
            let contentForm = $("#content-create-form-" + type);
            let data = new FormData(contentForm.get(0));

            data.append('containable', containable);
            data.append('containable_id', containableId);
            data.append('content_type', contentType);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('contents.store') }}",
                dataType: 'json',
                type: 'post',
                data: data,
                processData: false,
                contentType: false,
                success: function (data) {
                    $('#contentCreateModal').modal('hide');
                    dataTable.ajax.reload(null, false);
                    $('.content-form .form-control').val(null);
                    $('#summernote').summernote('reset');
                    $('.fileinput').removeClass('fileinput-exists').addClass('fileinput-new');
                    $('#existing-image').val(null);
                    hideErrors();
                    button.removeClass('disabled');
                },
                error: function (data) {
                    showErrors(data);
                    button.removeClass('disabled');
                }
            });
        })

        $(body).on('click', '#update-content', function () {
            let contentId = $('#content-id').val();
            let contentType = $('#content-type').val();
            let contentForm = $("#content-update-form-" + contentType);
            let button = $(this);
            button.addClass('disabled');

            let data = new FormData(contentForm.get(0));
            data.append('_method', 'put');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "/admin/contents/" + contentId,
                dataType: 'json',
                type: 'post',
                data: data,
                processData: false,
                contentType: false,
                success: function (data) {
                    $('#contentUpdateModal').modal('hide');
                    dataTable.ajax.reload(null, false);
                    hideErrors();
                    button.removeClass('disabled');
                },
                error: function (data) {
                    showErrors(data);
                    button.removeClass('disabled');
                }
            });
        })

        body.on('click', '.delete-content', function () {
            let contentId = $(this).attr('data-delete');
            let data = $("#delete-" + contentId).serializeArray();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{!! route('contents.destroy', ['containable' => get_class($resource), 'containable_id' => $resource->id]) !!}",
                dataType: 'json',
                type: 'post',
                data: data,
                success: function (data) {
                    dataTable.ajax.reload(null, false);
                },
                error: function (data) {
                    console.log(data);
                }
            });
        });

        body.on('click', '.edit-content', function () {
            let data = jQuery.parseJSON($(this).attr('data-content'));
            let mediaUrl = $(this).attr('data-media-thumb');
            let contentType = data.content_type.toLowerCase();
            let content = $('#content-update-' + contentType);

            $('.content-types').addClass('d-none');
            content.removeClass('d-none');

            $('#content-id').val(data.id);
            $('#content-type').val(contentType);

            $.each(data, function (element, value) {
                let field = content.find("[name='" + element + "']");
                field.val(value);

                if (field.is("select")) {
                    let selectPicker = content.find('.selectpicker');
                    selectPicker.selectpicker('val', value);
                }
                if (field.is("textarea")) {
                    let textarea = content.find('.summernote');
                    textarea.summernote("code", value);
                }
            });
            content.find('.fileinput-preview').html("<img class='mw-100' src='" + mediaUrl + "' alt='...'>");
            content.find('.fileinput').removeClass('fileinput-new').addClass('fileinput-exists');
        });

        body.on('click', '.show-content', function () {
            let data = jQuery.parseJSON($(this).attr('data-content'));
            let mediaUrl = $(this).attr('data-media-thumb');
            let content = $('#content-show-' + data.content_type.toLowerCase());

            $('.content-types').addClass('d-none');
            content.removeClass('d-none');

            $.each(data, function (element, value) {
                content.find('.content-' + element).html(value);
            });
            if (mediaUrl) {
                content.find('.media-url').attr('src', mediaUrl);
                let video = content.find('video');
                if (video.length > 0) {
                    video.attr('src', $(this).attr('data-media-url'));
                    video.get(0).load();
                }
            }
        });

        function showErrors(data) {
            hideErrors();

            let response = data.responseJSON;
            let errors = response.errors;
            if (errors) {
                $.each(errors, function (name, message) {
                    $('.error-danger-' + name).addClass('has-danger');
                    $('.error-' + name).removeClass('d-none').text('* ' + message[0]);
                });
            }
        }

        function hideErrors() {
            $('.error-span').addClass('d-none').text('');
            $('.error-danger').removeClass('has-danger');
        }
    </script>
@endsection
