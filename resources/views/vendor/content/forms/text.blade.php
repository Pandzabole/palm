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
        <div class="form-group error-danger error-danger-type">
            <label class="asterisk">Text Style</label>
            <select class="selectpicker form-control p-0" name="type">
                <option disabled>Select Style</option>
                @foreach(config('content.text_types') as $type)
                    <option value="{{ $type}}">{{ $type }}</option>
                @endforeach
            </select>
            <span class="text-danger d-none error-span error-type"></span>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="form-group error-danger error-danger-content">
            <label>Text</label>
            <input class="form-control" placeholder="Text" name="content" required>
            <span class="text-danger d-none error-content"></span>
        </div>
    </div>
</div>
