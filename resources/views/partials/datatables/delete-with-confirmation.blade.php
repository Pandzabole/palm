<form method="POST" action="{{route($routeModelName.'.destroy', $model->id) }}" class="d-none gl-delete-form">
    @csrf
    {{ method_field('DELETE') }}
</form>
<button type="submit" form="delete" class="btn btn-danger btn-icon gl-delete-btn">
    <i class="fa fa-trash"></i>
</button>
