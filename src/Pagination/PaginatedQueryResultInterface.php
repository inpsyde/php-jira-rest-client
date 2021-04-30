<?php

namespace JiraRestApi\Pagination;

/**
 * The interface for paginated queries results.
 * @template T
 */
interface PaginatedQueryResultInterface
{
    /**
     * Returns the starting item index in this result.
     * @return int
     */
    public function getStart(): int;

    /**
     * Returns the requested maximum number of items.
     * @return int
     */
    public function getLimit(): int;

    /**
     * Returns the actual number of items in this result.
     * @return int
     */
    public function getSize(): int;

    /**
     * Returns whether it is the last page.
     * @return bool
     */
    public function isLastPage(): bool;

    /**
     * @return T[]
     */
    public function getItems(): array;
}
