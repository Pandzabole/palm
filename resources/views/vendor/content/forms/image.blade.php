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
    <div class="col">
        <div class="form-group error-danger error-danger-alt">
            <label>Alt Text</label>
            <input class="form-control" placeholder="Alt" name="alt">
            <span class="text-danger d-none error-span error-alt"></span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col h-100">
        <div class="form-group error-danger error-danger-image">
            <label class="asterisk">Image</label>
            @include('partials.media.content-form', ['inputName' => 'image'])
            <span class="text-danger d-none error-span error-image"></span>
        </div>
    </div>
</div>
