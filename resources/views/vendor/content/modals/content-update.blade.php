<div class="modal fade" id="contentUpdateModal" tabindex="-1" role="dialog" aria-labelledby="contentUpdateModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="contentUpdateModalLabel">Update Content</h5>
            </div>
            <div class="modal-body" style="height: 500px; overflow-y: auto">
                <div class="row">
                    <div class="col">
                        @foreach(config('content.types') as $contentType => $class)
                            <form id="content-update-form-{{ $contentType }}" class="content-form"
                                  enctype="multipart/form-data">
                                <div id="content-update-{{ $contentType }}" class="content-types d-none">
                                    <input type="hidden" name="content_type_class" value="{{ $class }}">
                                    {!! (new $class())->renderForm() !!}
                                </div>
                            </form>
                        @endforeach
                    </div>
                </div>
                <input type="hidden" id="content-id" name="id">
                <input type="hidden" id="content-type">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="update-content">Update</button>
            </div>
        </div>
    </div>
</div>
