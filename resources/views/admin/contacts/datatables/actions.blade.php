<div>
<a href="{{ route('contacts.show', $id) }}" class="btn btn-primary btn-fab btn-icon btn-round">
    <i class="fa fa-eye"></i>
</a>
@include('partials.datatables.delete-with-confirmation', ['model' => $model, 'routeModelName' => $routeModelName])
</div>
