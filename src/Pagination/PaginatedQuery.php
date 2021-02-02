<?php

namespace JiraRestApi\Pagination;

use Generator;
use RangeException;

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
        $this->start = $this->initialIndex();
        $this->queryCallback = $queryCallback;
        $this->parseItemCallback = $parseItemCallback;
    }

    public function getStart(): int
    {
        return $this->start;
    }

    public function withStart(int $start)
    {
        if ($start < $this->initialIndex()) {
            throw new RangeException(sprintf('Incorrect start index %1$d, must be not less than %2$d.',
                $start, $this->initialIndex()));
        }

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
        $query = $this->withStart($this->initialIndex());

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

    protected function initialIndex(): int
    {
        return 0;
    }
}
