<div class="row">
    <div class="col">
        <div class="form-group error-danger error-danger-name">
            <label>Name</label>
            <input class="form-control" placeholder="Name" name="name" required>
            <span class="text-danger d-none error-span error-name"></span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col h-100">
        <div class="form-group error-danger error-danger-video">
            <label class="asterisk">Video</label>
            @include('partials.media.content-form', ['inputName' => 'video'])
            <span class="text-danger d-none error-span error-video"></span>
        </div>
    </div>
</div>
