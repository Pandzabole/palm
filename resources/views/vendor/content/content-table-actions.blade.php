<button class="btn btn-primary btn-fab btn-icon btn-round show-content"
        data-toggle="modal"
        data-target="#contentShowModal"
        data-media-thumb="{{ $model->media ? $model->firstMediaThumb() : null  }}"
        data-media-url="{{ $model->media ? $model->firstMediaUrl() : null  }}"
        data-content="{{ $model->toJson() }}">
    <i class="fa fa-eye"></i>
</button>
<button class="btn btn-warning btn-fab btn-icon btn-round edit-content"
        data-toggle="modal"
        data-target="#contentUpdateModal"
        data-media-thumb="{{ $model->media ? $model->firstMediaThumb() : null  }}"
        data-media-url="{{ $model->media ? $model->firstMediaUrl() : null  }}"
        data-content="{{ $model->toJson() }}">
    <i class="fa fa-edit"></i>
</button>
<form method="POST" id="delete-{{ $id }}" class="d-none">
    <input type="hidden" name="content_type" value="{{ get_class($model) }}">
    <input type="hidden" name="content_id" value="{{ $id }}">
    @csrf
</form>

<button type="button" data-delete="{{ $id }}"
        class="btn btn-danger btn-fab btn-icon btn-round delete-content">
    <i class="fa fa-trash"></i>
</button>
