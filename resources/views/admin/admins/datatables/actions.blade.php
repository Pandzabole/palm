<div>
    <a href="{{ route('admins.show', $model->id) }}" class="btn btn-primary btn-icon ">
        <i class="fa fa-eye"></i>
    </a>
    <a href="{{ route('admins.edit', $model->id) }}" class="btn btn-warning btn-icon">
        <i class="fa fa-edit"></i>
    </a>
    @if(auth()->user()->id !== $model->id)
        @include('partials.datatables.delete-with-confirmation', ['model' => $model, 'routeModelName' => 'admins'])
    @endif
</div>
