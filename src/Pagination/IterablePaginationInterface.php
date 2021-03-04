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
     * Usually it should be implemented via generators (yield), that is not loading all hundreds of pages at once.
     * @return iterable<PaginatedQueryResultInterface<T>>
     * @throws Exception
     */
    public function allPages(): iterable;
}
