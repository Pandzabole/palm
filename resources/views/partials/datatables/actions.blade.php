<div>
    <a href="{{ route($routeModelName.'.show', $model->id) }}" class="btn btn-primary btn-icon ">
        <i class="fa fa-eye"></i>
    </a>
    <a href="{{ route($routeModelName.'.edit', $model->id) }}" class="btn btn-warning btn-icon">
        <i class="fa fa-edit"></i>
    </a>
    @include('partials.datatables.delete-with-confirmation', ['model' => $model, 'routeModelName' => $routeModelName])
</div>
