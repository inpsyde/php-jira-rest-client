<?php

namespace JiraRestApi\Pagination;

/**
 * Immutable result of a paginated query.
 * @template T
 * @implements PaginatedQueryResultInterface<T>
 */
class PaginatedQueryResult implements PaginatedQueryResultInterface
{
    /**
     * @var int
     */
    protected $start;

    /**
     * @var int
     */
    protected $limit;

    /**
     * @var int
     */
    protected $size;

    /**
     * @var bool
     */
    protected $isLastPage;

    /**
     * @var T[]
     */
    protected $items;

    /**
     * @param int $start
     * @param int $limit
     * @param int $size
     * @param bool $isLastPage
     * @param T[] $items
     */
    public function __construct(int $start, int $limit, int $size, bool $isLastPage, array $items)
    {
        $this->start = $start;
        $this->limit = $limit;
        $this->size = $size;
        $this->isLastPage = $isLastPage;
        $this->items = $items;
    }

    public function getStart(): int
    {
        return $this->start;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function isLastPage(): bool
    {
        return $this->isLastPage;
    }

    /**
     * @inheritDoc
     * @return T[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
