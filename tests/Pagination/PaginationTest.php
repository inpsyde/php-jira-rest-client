<?php

namespace JiraRestApi\Test\Pagination;

use JiraRestApi\Pagination\PaginatedQuery;
use PHPUnit\Framework\TestCase;

class PaginationTest extends TestCase
{
    private $data = [];

    protected function setUp(): void
    {
        parent::setUp();

        for ($i = 0; $i < 5; $i++) {
            $this->data[] = (object) ['id' => $i];
        }
    }

    public function testPagination()
    {
        $query = new PaginatedQuery(function (array $paginationQuery) {
            ['start' => $start, 'limit' => $limit] = $paginationQuery;
            $items = array_slice($this->data, $start, $limit);
            return (object) [
                'start' => $start,
                'limit' => $limit,
                'size' => count($items),
                'isLastPage' => ($start + $limit) >= count($this->data),
                'values' => $items,
            ];
        }, function ($itemData) {
            return (object) array_merge((array) $itemData, ['newprop' => 'foo' . $itemData->id]);
        });

        $result = $query->execute();

        self::assertEquals(0, $result->getStart());
        self::assertEquals(50, $result->getLimit());
        self::assertEquals(count($this->data), $result->getSize());
        self::assertTrue($result->isLastPage());
        self::assertEquals(array_map(function ($obj) {
            return (object) array_merge((array) $obj, ['newprop' => 'foo' . $obj->id]);
        }, $this->data), $result->getItems());

        $result = $query->withLimit(2)->execute();

        self::assertEquals(0, $result->getStart());
        self::assertEquals(2, $result->getLimit());
        self::assertEquals(2, $result->getSize());
        self::assertFalse($result->isLastPage());
        self::assertEquals([(object) ['id' => 0, 'newprop' => 'foo0'], (object) ['id' => 1, 'newprop' => 'foo1']], $result->getItems());

        $result = $query->withStart(2)->withLimit(2)->execute();

        self::assertEquals(2, $result->getStart());
        self::assertEquals(2, $result->getLimit());
        self::assertEquals(2, $result->getSize());
        self::assertFalse($result->isLastPage());
        self::assertEquals([(object) ['id' => 2, 'newprop' => 'foo2'], (object) ['id' => 3, 'newprop' => 'foo3']], $result->getItems());

        $result = $query->withStart(4)->withLimit(2)->execute();

        self::assertEquals(4, $result->getStart());
        self::assertEquals(2, $result->getLimit());
        self::assertEquals(1, $result->getSize());
        self::assertTrue($result->isLastPage());
        self::assertEquals([(object) ['id' => 4, 'newprop' => 'foo4']], $result->getItems());
    }
}
