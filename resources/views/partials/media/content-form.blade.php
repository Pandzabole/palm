@section('css-links')
    @parent
    <link rel="stylesheet" href="{{ asset('css/jasny-bootstrap.min.css') }}">
    <style>
        .fileinput-exists img {
            max-width: 100%;
        }
    </style>
@endsection

<div class="form-group">
    <div class="form-control fileinput fileinput-new text-center h-100" style="min-width: 100%"
         data-provides="fileinput">
        <div class="fileinput-new thumbnail img-raised">
            <img src="{{ asset('img/default-avatar.png') }}" style="object-fit: contain;" alt="Image avatar">
        </div>
        <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
        <div class="mt-2">
            <span class="btn btn-raised btn-round btn-default btn-file">
                <span class="fileinput-new">Add</span>
                <span class="fileinput-exists">Change</span>
                <input type="file" name="{{$inputName}}" id="image"/>
            </span>
            <button type="button" class="btn btn-round btn-default" data-toggle="modal" data-target="#media-modal-">
                Choose existing
            </button>
            <a href="javascript:" class="btn btn-danger btn-round fileinput-exists" id="remove-file"
               data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
            <input type="hidden" name="media_id" class="existing-image">
        </div>
    </div>
</div>

@section('js-links')
    @parent
    <script src="{{ asset('js/jasny-bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/media-model.js') }}"></script>
@endsection
