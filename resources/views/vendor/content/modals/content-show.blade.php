<div class="modal fade" id="contentShowModal" tabindex="-1" role="dialog" aria-labelledby="contentShowModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="contentShowModalLabel">Content</h5>
            </div>
            <div class="modal-body" style="height: 500px; overflow-y: auto">
                <div class="row">
                    <div class="col">
                        @foreach(config('content.types') as $contentType => $class)
                            <div id="content-show-{{ $contentType }}" class="content-types d-none">
                                {!! (new $class)->renderShow() !!}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
