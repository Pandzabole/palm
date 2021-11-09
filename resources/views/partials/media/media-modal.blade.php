<div class="modal fade media-modal" id="media-modal-{{$mediaModalId ?? ''}}" tabindex="-1" role="dialog" aria-labelledby="mediaModalLabel"
     aria-hidden="true" style="z-index: 111111;">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document" style="overflow-y: initial!important;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="mediaModalLabel">Choose media</h5>
            </div>
            <div class="modal-body" style="height: 450px; overflow-y: auto">
                <div class="row">
                    @foreach($media as $item)
                        <div class="col-4">
                            <div class="card">
                                <img class="card-img-top" style="object-fit: contain;" src="{{ asset($item->getThumbUrl()) }}" alt="Card image cap">
                                <div class="card-body">
                                    <button class="btn btn-primary image-select"
                                            data-media-url="{{ asset($item->getThumbUrl()) }}"
                                            data-media-id="{{ $item->id }}"
                                            data-dismiss="modal"> Select
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
