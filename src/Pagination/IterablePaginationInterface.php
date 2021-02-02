<?php

namespace JiraRestApi\Pagination;

use Exception;
use Generator;

/**
 * The interface providing a way to iterate through all pages of a paginated query.
 * @template T
 */
interface IterablePaginationInterface
{
    /**
     * Returns all pages.
     * @return Generator<PaginatedQueryResultInterface<T>>
     * @throws Exception
     */
    public function allPages(): Generator;
}
