<?php

namespace JiraRestApi\Pagination;

use Exception;
use RangeException;

/**
 * The interface for paginated query.
 * Use withStart() and withLimit() to set the query position, and execute() to query the result.
 * @template T
 * @extends IterablePaginationInterface<T>
 */
interface PaginatedQueryInterface extends IterablePaginationInterface
{
    /**
     * Returns the current starting item index that will be queried.
     * @return int
     */
    public function getStart(): int;

    /**
     * Returns a new instance which has the start set to what is specified.
     * @param int $start The starting item index that will be queried.
     * @return static A new instance which has the value set to what is specified.
     * @throws RangeException If invalid $start.
     */
    public function withStart(int $start);

    /**
     * Returns the current maximum number of items that will be queried.
     * @return int
     */
    public function getLimit(): int;

    /**
     * Returns a new instance which has the limit set to what is specified.
     * @param int $limit The maximum number of items that will be queried.
     * @return static
     */
    public function withLimit(int $limit);

    /**
     * Executes the query with the current parameters and returns result.
     * @return PaginatedQueryResultInterface<T>
     * @throws Exception
     */
    public function execute(): PaginatedQueryResultInterface;
}
