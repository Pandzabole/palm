<div class="modal fade" id="contentCreateModal" tabindex="-1" role="dialog" aria-labelledby="contentCreateModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="contentCreateModalLabel">Choose content type</h5>
            </div>
            <div class="modal-body" style="height: 500px; overflow-y: auto">
                <div class="row">
                    <div class="col">
                        <div class="form-group error-danger error-danger-content_type">
                            <label for="content-types"></label>
                            <select class="form-control content-types-select p-0" id="content-types"
                                    name="content_type">
                                <option disabled selected>Choose Type</option>
                                @foreach(config('content.types') as $contentType => $class)
                                    <option data-type={{ $contentType }} value="{{ $class }}">
                                        {{ \Illuminate\Support\Str::title(str_replace('_',' ', $contentType)) }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="text-danger d-none error-span error-content_type"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        @foreach(config('content.types') as $contentType => $class)
                            <form id="content-create-form-{{ $contentType }}" class="content-form"
                                  enctype="multipart/form-data">
                                <div id="content-{{ $contentType }}" class="content-types  d-none">
                                    {!! (new $class)->renderForm() !!}
                                </div>
                            </form>
                        @endforeach
                    </div>
                </div>
                <input type="hidden" name="containable" id="containable-create" value="{{ get_class($resource) }}">
                <input type="hidden" name="containable_id" id="containable-id-create" value="{{ $resource->id }}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submit-content">Add</button>
            </div>
        </div>
    </div>
</div>
