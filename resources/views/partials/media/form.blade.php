@section('css-links')
    @parent
    <link href="{{ asset('css/jasny-bootstrap.min.css') }}" rel="stylesheet">
@endsection
<div class="form-group @if($errors->has($inputName)) has-danger @endif form-group-input-image-avatar">
    <div
        class="form-control fileinput @if($exists) fileinput-exists @else fileinput-new @endif text-center input-image-avatar min-w-100"
        data-provides="fileinput">
        <div class="fileinput-new thumbnail img-raised input-image-form-grout">
            <img class="image-form-group" src="{{ asset('img/default-avatar.png') }}" alt="Image avatar">
        </div>
        <div class="fileinput-preview image-form-group fileinput-exists thumbnail img-raised mb-6">
            @if($exists)
                <img class="" style="object-fit: contain;" src="{{ asset($mediaUrl ?? 'img/default-avatar.png') }}" alt="...">
            @endif
        </div>
        <div>
            <span class="btn btn-raised btn-round btn-default btn-file add-new-image-btn">
                <span class="fileinput-new">Add</span>
                <span class="fileinput-exists">Change</span>
                <input type="file" class="input-{{$inputName}}" name="{{ $inputName }}"/>
            </span>
            <button type="button" class="btn btn-round btn-default choose-existing-btn" data-toggle="modal"
                    data-target="#{{ $mediaModal ?? 'mediaModal' }}">
                Choose existing
            </button>
            <a href="javascript:" class="btn btn-danger btn-round fileinput-exists remove-file mt-3"
               data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
            @if($exists)
                <input type="hidden" name="{{ $deleteName ?? 'deleted' }}" class="deleted-image">
            @endif
            <input type="hidden" name="{{ $mediaName ?? 'media_id' }}" value="{{ $mediaId ?? '' }}"
                   class="existing-image {{ $mediaName ?? 'media_id' }}">
        </div>
    </div>
</div>
@if($errors->has($inputName))
    <span class="text-danger">*{{ $errors->first($inputName) }}</span>
@endif

@section('js-links')
    @parent
    <script src="{{ asset('js/jasny-bootstrap.min.js') }}"></script>
    <script>
        $('.remove-file').on('click', function () {
            $(this).siblings('.existing-image').val(null);
            $(this).siblings('.deleted-image').val(true);
        });

        $('.input-image').on('change', function () {
            $(this).parent().siblings('.existing-image').val(null);
        });
    </script>
@endsection
