<?php

namespace App\Repositories;

use App\Models\Content\Content;
use App\Repositories\Contracts\ContentRepository as ContentRepositoryInterface;
use App\Repositories\Infrastructure\EloquentRepository;

class ContentRepository extends EloquentRepository implements ContentRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function reorderSortable(array $data): void
    {
        $items = collect($data['items'])->keyBy('old');
        $contentable = $data['containable'];
        $contentableId = $data['containable_id'];

        $records = $this->model
            ->where('containable_type', $contentable)
            ->where('containable_id', $contentableId)
            ->whereIn($this->model->sortable, $items->keys())
            ->get();

        foreach ($records as $record) {
            $newItem = $items[$record->{$this->model->sortable}]['new'];
            $record->{$this->model->sortable} = $newItem;
            $record->save();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function storeWithSortable(array $data, bool $asc = true)
    {
        $lastRecord = $this->model
            ->where('containable_type', $data['containable_type'])
            ->where('containable_id', $data['containable_id'])
            ->orderBy($this->model->sortable, 'desc')
            ->first();

        $data[$this->model->sortable] = $lastRecord ? $lastRecord->{$this->model->sortable} + 1 : 1;

        return $this->store($data);
    }

    /**
     * {@inheritdoc}
     */
    public function deleteContentWithSortable(Content $content, $data): void
    {
        $sortable = $content->{$this->model->sortable};
        tap($content)->delete();

        $this->model
            ->where('containable_type', $data['containable'])
            ->where('containable_id', $data['containable_id'])
            ->where($this->model->sortable, '>', $sortable)
            ->decrement($this->model->sortable);
    }
}
