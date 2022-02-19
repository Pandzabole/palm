<?php

namespace App\Repositories\Infrastructure;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface BaseRepository
{
    /**
     * Get all with or without trashed.
     *
     * @param array $relationships
     * @param bool $trashed
     */
    public function getAll(array $relationships = [], bool $trashed = false);

    /**
     * Find a resource by id.
     *
     * @param string $id
     * @throws ModelNotFoundException
     */
    public function findOneById(string $id);

    /**
     * Find a resource by key value criteria.
     *
     * @param array $criteria
     * @param array $relationships
     * @throws ModelNotFoundException
     */
    public function findOneBy(
        array $criteria = [],
        array $relationships = []
    );

    /**
     * Search All resources by query builder.
     *
     * @param string $orderParam
     * @param string $orderType
     * @param array $criteria
     * @param array $relationships
     * @param int|null $limit
     */
    public function findByFilters(
        string $orderParam = 'created_at',
        string $orderType = 'desc',
        array $criteria = [],
        array $relationships = [],
        int $limit = null
    );

    /**
     * @param int $limit
     * @param string $orderParam
     * @param string $orderType
     * @param array $criteria
     * @param array $relationships
     */
    public function findByPaginate(
        int $limit,
        string $orderParam = 'created_at',
        string $orderType = 'desc',
        array $criteria = [],
        array $relationships = []
    );

    /**
     * @param string $relationship
     * @param array $data
     */
    public function findByHasRelationship(string $relationship, array $data);

    /**
     * @param string $relationship
     * @param array $data
     * @param array $orWhereData
     * @param array $whereCriteria
     */
    public function findByHasOrWhereRelationship(string $relationship, array $data, array $orWhereData, array $whereCriteria = []);

    /**
     * Save a resource.
     *
     * @param array $data
     */
    public function store(array $data);

    /**
     * Update a resource.
     *
     * @param Model $model
     * @param array $data
     */
    public function update(Model $model, array $data);

    /**
     * Create or update a record matching the attributes, and fill it with values.
     *
     * @param array $attributes
     * @param array $data
     */
    public function updateOrCreate(array $attributes, array $data);

    /**
     * Update multiple records matching the criteria, and fill it with values.
     *
     * @param array $criteria
     * @param array $data
     */
    public function updateMultiple(array $criteria, array $data);

    /**
     * Attach relationship data to model
     *
     * @param Model $model
     * @param string $relationship
     * @param array $data
     */
    public function attach(Model $model, string $relationship, array $data);

    /**
     * Sync relationship data to model
     *
     * @param Model $model
     * @param string $relationship
     * @param array $data
     */
    public function sync(Model $model, string $relationship, array $data);

    /**
     * Sync without detaching relationship data to model
     *
     * @param Model $model
     * @param string $relationship
     * @param array $data
     */
    public function syncWithoutDetaching(Model $model, string $relationship, array $data);

    /**
     * Sync morph relationship data to model
     *
     * @param Model $model
     * @param string $relationship
     * @param array $data
     * @param string|null $morphType
     */
    public function syncMorph(Model $model, string $relationship, array $data, string $morphType = 'component_type');

    /**
     * Attach without detaching morph relationship data to model
     *
     * @param Model $model
     * @param string $relationship
     * @param array $data
     * @param string|null $morphType
     */
    public function syncWithoutDetachingMorph(
        Model $model,
        string $relationship,
        array $data,
        string $morphType = 'component_type'
    );

    /**
     * Attach morph relationship data to model
     *
     * @param Model $model
     * @param string $relationship
     * @param array $data
     * @param string|null $morphType
     */
    public function attachMorph(Model $model, string $relationship, array $data, string $morphType = 'component_type');

    /**
     * Delete a resource.
     *
     * @param Model $model
     */
    public function delete(Model $model);

    /**
     * Delete a resource.
     *
     * @param array $ids
     */
    public function deleteAll(array $ids);

    /**
     * Store resource and increment sortable field
     *
     * @param array $data
     * @param bool $asc
     */
    public function storeWithSortable(array $data, bool $asc = true);

    /**
     * Delete resource and decrement sortable fields
     *
     * @param Model $model
     */
    public function deleteWithSortable(Model $model);

    /**
     * Reorder model records
     *
     * @param array $data
     */
    public function reorderSortable(array $data);
}
