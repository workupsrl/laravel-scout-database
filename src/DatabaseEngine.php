<?php

declare(strict_types=1);

namespace Workup\Scout\Database;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection;
use Laravel\Scout\Builder;
use Laravel\Scout\Engines\Engine;
use Laravel\Scout\Searchable;

/**
 * A Laravel Scout search engine utilizing an SQL database for indexing and search.
 *
 * @package Workup\Scout\Database
 */
class DatabaseEngine extends Engine
{
    /**
     * DatabaseEngine constructor.
     */
    public function __construct(
        private DatabaseIndexer $indexer,
        private DatabaseSeeker $seeker
    )
    {
    }

    /**
     * Update the given model in the index.
     *
     * @param EloquentCollection|Model[] $models
     * @throws ScoutDatabaseException
     */
    public function update($models): void
    {
        $this->indexer->index($models);
    }

    /**
     * Remove the given model from the index.
     *
     * @param EloquentCollection|Model[] $models
     * @throws ScoutDatabaseException
     */
    public function delete($models): void
    {
        $this->indexer->deleteFromIndex($models);
    }

    /**
     * Flush all of the model's records from the engine.
     *
     * @param Model $model
     * @throws ScoutDatabaseException
     */
    public function flush($model): void
    {
        $this->indexer->deleteEntireModelFromIndex($model);
    }

    /**
     * Perform the given search on the engine.
     */
    public function search(Builder $builder): SearchResult
    {
        return $this->seeker->search($builder);
    }

    /**
     * Perform the given search on the engine.
     *
     * @param int $perPage
     * @param int $page
     */
    public function paginate(Builder $builder, $perPage, $page): SearchResult
    {
        return $this->seeker->search($builder, $page, $perPage);
    }

    /**
     * Pluck and return the primary keys of the given results.
     *
     * @param SearchResult $results
     */
    public function mapIds($results): Collection
    {
        return collect($results->getIdentifiers());
    }

    /**
     * Map the given results to instances of the given model.
     *
     * @param SearchResult     $results
     * @param Model|Searchable $model
     * @throws \InvalidArgumentException
     */
    public function map(Builder $builder, $results, $model): EloquentCollection
    {
        $objectIds = $results->getIdentifiers();

        if (count($objectIds) === 0) {
            return EloquentCollection::make();
        }

        $objectIdPositions = array_flip($objectIds);

        return $model->getScoutModelsByIds($builder, $objectIds)
            ->filter(fn ($model) => in_array($model->getScoutKey(), $objectIds))
            ->sortBy(fn ($model) => $objectIdPositions[$model->getScoutKey()])
            ->values();
    }

    /**
     * Map the given results to instances of the given model via a lazy collection.
     *
     * @param mixed            $results
     * @param Model|Searchable $model
     */
    public function lazyMap(Builder $builder, $results, $model): LazyCollection
    {
        $objectIds = $results->getIdentifiers();

        if (count($objectIds) === 0) {
            return LazyCollection::empty();
        }

        $objectIdPositions = array_flip($objectIds);

        return $model->queryScoutModelsByIds($builder, $objectIds)
            ->cursor()
            ->filter(fn ($model) => in_array($model->getScoutKey(), $objectIds))
            ->sortBy(fn ($model) => $objectIdPositions[$model->getScoutKey()])
            ->values();
    }

    /**
     * Get the total count from a raw result returned by the engine.
     *
     * @param SearchResult $results
     */
    public function getTotalCount($results): int
    {
        return $results->getHits();
    }

    /**
     * Create a search index.
     *
     * @param string $name
     * @throws ScoutDatabaseException
     */
    public function createIndex($name, array $options = []): void
    {
        throw new ScoutDatabaseException('Scout Database indexes are created automatically upon adding objects (index table must exist).');
    }

    /**
     * Delete a search index.
     *
     * @param string $name
     * @throws ScoutDatabaseException
     */
    public function deleteIndex($name): void
    {
        $this->indexer->deleteIndex($name);
    }
}
