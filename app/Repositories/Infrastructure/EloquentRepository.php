<?php

namespace App\Repositories\Infrastructure;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

abstract class EloquentRepository implements BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * {@inheritDoc}
     */
    public function getAll(array $relationships = [], bool $trashed = false)
    {
        $query = $this->model
            ->with($relationships)
            ->orderBy('created_at', 'desc')
            ->get();
        if ($trashed) {
            $query = $this->model
                ->with($relationships)
                ->orderBy('created_at', 'desc')
                ->withTrashed()
                ->get();
        }

        return $query;
    }

    /**
     * {@inheritdoc}
     */
    public function findOneById(string $id)
    {
        return $this->findOneBy(['id' => $id]);
    }

    /**
     * {@inheritdoc}
     */
    public function findOneBy(array $criteria = [], array $relationships = [])
    {
        return $this->model
            ->where($criteria)
            ->with($relationships)
            ->orderBy('created_at', 'desc')
            ->firstOrFail();
    }

    /**
     * {@inheritdoc}
     */
    public function findByFilters(
        string $orderParam = 'created_at',
        string $orderType = 'desc',
        array $criteria = [],
        array $relationships = [],
        int $limit = null
    )
    {
        return $this->model
            ->where($criteria)
            ->with($relationships)
            ->orderBy($orderParam, $orderType)
            ->take($limit)
            ->get();
    }

    /**
     * {@inheritdoc}
     */
    public function findByPaginate(
        int $limit,
        string $orderParam = 'created_at',
        string $orderType = 'desc',
        array $criteria = [],
        array $relationships = []
    )
    {
        return $this->model
            ->where($criteria)
            ->with($relationships)
            ->orderBy($orderParam, $orderType)
            ->paginate($limit);
    }

    /**
     * @inheritDoc
     */
    public function findByHasRelationship(string $relationship, array $data)
    {
        return $this->model->whereHas($relationship, function (Builder $query) use ($data) {
            return $query->where($data);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * {@inheritdoc}
     */
    public function update(Model $model, array $data)
    {
        return tap($model)->update($data);
    }

    /**
     * {@inheritDoc}
     */
    public function updateOrCreate(array $attributes, array $data)
    {
        return $this->model->updateOrCreate($attributes, $data);
    }

    /**
     * {@inheritDoc}
     */
    public function updateMultiple(array $criteria, array $data)
    {
        $this->model->where($criteria)->update($data);
    }

    /**
     * {@inheritDoc}
     */
    public function attach(Model $model, string $relationship, array $data)
    {
        return $model->$relationship()->attach($data);
    }

    /**
     * {@inheritDoc}
     */
    public function sync(Model $model, string $relationship, array $data)
    {
        return $model->$relationship()->sync($data);
    }

    /**
     * {@inheritDoc}
     */
    public function syncWithoutDetaching(Model $model, string $relationship, array $data)
    {
        return $model->$relationship()->syncWithoutDetaching($data);
    }

    /**
     * {@inheritDoc}
     */
    public function syncMorph(Model $model, string $relationship, array $data, string $morphType = 'component_type')
    {
        $pivotData = [];

        foreach ($data as $datum) {
            $pivotData[$datum] = [$morphType => get_class($model)];
        }

        return $model->$relationship()->sync($pivotData);
    }

    /**
     * {@inheritDoc}
     */
    public function syncWithoutDetachingMorph(
        Model $model,
        string $relationship,
        array $data,
        string $morphType = 'component_type'
    )
    {
        $pivotData = [];

        foreach ($data as $datum) {
            $pivotData[$datum] = [$morphType => get_class($model)];
        }

        return $model->$relationship()->syncWithoutDetaching($pivotData);
    }

    /**
     * {@inheritDoc}
     */
    public function attachMorph(Model $model, string $relationship, array $data, string $morphType = 'component_type')
    {
        $pivotData = [];

        foreach ($data as $datum) {
            $pivotData[$datum] = [$morphType => get_class($model)];
        }

        return $model->$relationship()->attach($pivotData);
    }

    /**
     * {@inheritdoc}
     */
    public function delete(Model $model)
    {
        return tap($model)->delete();
    }

    /**
     * {@inheritDoc}
     */
    public function deleteAll(array $ids)
    {
        return $this->model->whereIn('id', $ids)->delete();
    }

    /**
     * {@inheritdoc}
     */
    public function storeWithSortable(array $data, bool $asc = true)
    {
        $sortable = 1;

        if ($asc) {
            $this->model->increment($this->model->sortable);
        } else {
            $lastRecord = $this->findByFilters($this->model->sortable)->first();
            $sortable = $lastRecord ? $lastRecord->{$this->model->sortable} + 1 : $sortable;
        }

        $data[$this->model->sortable] = $sortable;

        return $this->store($data);
    }

    /**
     * {@inheritdoc}
     */
    public function deleteWithSortable(Model $model): void
    {
        $sortable = $model->{$this->model->sortable};
        tap($model)->delete();

        $this->model->where($this->model->sortable, '>', $sortable)->decrement($this->model->sortable);
    }

    /**
     * {@inheritdoc}
     */
    public function reorderSortable(array $data): void
    {
        $items = collect($data)->keyBy('old');

        $records = $this->model->whereIn($this->model->sortable, $items->keys())->get();

        foreach ($records as $record) {
            $newItem = $items[$record->{$this->model->sortable}]['new'];
            $record->{$this->model->sortable} = $newItem;
            $record->save();
        }
    }
}
