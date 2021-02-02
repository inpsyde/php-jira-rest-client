<?php

namespace JiraRestApi\Pagination;

use Generator;

/**
 * Generic paginated query.
 * Pass the functions performing the actual query and item parsing to the constructor.
 * Use withStart() and withLimit() to set the query position, and execute() to query the result.
 * @template T
 * @implements PaginatedQueryInterface<T>
 */
class PaginatedQuery implements PaginatedQueryInterface
{
    /**
     * @var int
     */
    protected $start = 0;

    /**
     * @var int
     */
    protected $limit = 50;

    /**
     * @var callable(array):object
     */
    protected $queryCallback;

    /**
     * @var callable(object):T
     */
    protected $parseItemCallback;

    /**
     * @param callable(array):object $queryCallback
     * The function performing the query and returning parsed result,
     * accepts the current pagination query parameters (can be passed to e.g. http_build_query).
     * @param callable(object):T $parseItemCallback
     * The function parsing the items,
     * accepts the item data and returns the object of type T.
     */
    public function __construct(callable $queryCallback, callable $parseItemCallback)
    {
        $this->queryCallback = $queryCallback;
        $this->parseItemCallback = $parseItemCallback;
    }

    public function getStart(): int
    {
        return $this->start;
    }

    public function withStart(int $start)
    {
        $query = clone $this;
        $query->start = $start;
        return $query;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function withLimit(int $limit)
    {
        $query = clone $this;
        $query->limit = $limit;
        return $query;
    }

    /**
     * @inheritDoc
     * @return PaginatedQueryResultInterface<T>
     */
    public function execute(): PaginatedQueryResultInterface
    {
        $response = (array) ($this->queryCallback)($this->getQueryParameters());

        return new PaginatedQueryResult(
            $response['start'],
            $response['limit'],
            $response['size'],
            $response['isLastPage'],
            array_map($this->parseItemCallback, $response['values'])
        );
    }

    /**
     * @inheritDoc
     * @return Generator<PaginatedQueryResultInterface<T>>
     */
    public function allPages(): Generator
    {
        $query = $this->withStart(0);

        while (true) {
            $result = $query->execute();

            if ($result->getSize() === 0) {
                break;
            }

            yield $result;

            if ($result->isLastPage()) {
                break;
            }

            $query = $query->withStart($query->getStart() + $this->getLimit());
        }
    }

    protected function getQueryParameters(): array
    {
        return [
            'start' => $this->start,
            'limit' => $this->limit,
        ];
    }
}
