<?php

namespace JiraRestApi\Test\Pagination;

use JiraRestApi\Pagination\PaginatedQuery;
use PHPUnit\Framework\TestCase;
use RangeException;

class PaginationTest extends TestCase
{
    protected $data = [];

    protected $queryFunc;
    protected $parseFunc;

    protected $queriesCount = 0;

    protected function setUp(): void
    {
        parent::setUp();

        for ($i = 0; $i < 5; $i++) {
            $this->data[] = (object) ['id' => $i];
        }

        $this->queryFunc = function (array $paginationQuery) {
            $this->queriesCount++;

            ['start' => $start, 'limit' => $limit] = $paginationQuery;
            $items = array_slice($this->data, $start, $limit);
            return (object) [
                'start' => $start,
                'limit' => $limit,
                'size' => count($items),
                'isLastPage' => ($start + $limit) >= count($this->data),
                'values' => $items,
            ];
        };

        $this->parseFunc = function ($itemData) {
            return (object) array_merge((array) $itemData, ['newprop' => 'foo' . $itemData->id]);
        };
    }

    public function testPagination()
    {
        $query = new PaginatedQuery($this->queryFunc, $this->parseFunc);

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

        $this->queriesCount = 0;

        $pages = [];
        foreach ($query->withLimit(2)->allPages() as $page) {
            $pages[] = $page;
        }

        self::assertCount(3, $pages);
        self::assertEquals([(object) ['id' => 0, 'newprop' => 'foo0'], (object) ['id' => 1, 'newprop' => 'foo1']], $pages[0]->getItems());
        self::assertEquals([(object) ['id' => 2, 'newprop' => 'foo2'], (object) ['id' => 3, 'newprop' => 'foo3']], $pages[1]->getItems());
        self::assertEquals([(object) ['id' => 4, 'newprop' => 'foo4']], $pages[2]->getItems());
        self::assertEquals(3, $this->queriesCount);
    }

    public function testEmptyResult()
    {
        $this->data = [];

        $query = new PaginatedQuery($this->queryFunc, $this->parseFunc);

        $result = $query->execute();

        self::assertEquals(0, $result->getSize());
        self::assertTrue($result->isLastPage());
        self::assertEmpty($result->getItems());

        $pages = [];
        foreach ($query->allPages() as $page) {
            $pages[] = $page;
        }

        self::assertEmpty($pages);
    }

    public function testPaginationWhenHasInitialResponse()
    {
        $query = new PaginatedQuery($this->queryFunc, $this->parseFunc, (object) [
            'start' => 0,
            'limit' => 2,
            'size' => 2,
            'isLastPage' => false,
            'values' => array_slice($this->data, 0, 2),
        ]);

        $pages = [];
        foreach ($query->withLimit(2)->allPages() as $page) {
            $pages[] = $page;
        }

        self::assertCount(3, $pages);
        self::assertEquals([(object) ['id' => 0, 'newprop' => 'foo0'], (object) ['id' => 1, 'newprop' => 'foo1']], $pages[0]->getItems());
        self::assertEquals([(object) ['id' => 2, 'newprop' => 'foo2'], (object) ['id' => 3, 'newprop' => 'foo3']], $pages[1]->getItems());
        self::assertEquals([(object) ['id' => 4, 'newprop' => 'foo4']], $pages[2]->getItems());
        self::assertEquals(2, $this->queriesCount);
    }

    public function testPaginationWhenEmptyInitialResponse()
    {
        $query = new PaginatedQuery($this->queryFunc, $this->parseFunc, (object) [
            'start' => 0,
            'limit' => 2,
            'size' => 0,
            'isLastPage' => true,
            'values' => [],
        ]);

        $pages = [];
        foreach ($query->allPages() as $page) {
            $pages[] = $page;
        }

        self::assertEmpty($pages);
        self::assertEquals(0, $this->queriesCount);
    }

    public function testInvalidStart()
    {
        $query = new PaginatedQuery($this->queryFunc, $this->parseFunc);

        $this->expectException(RangeException::class);

        $query->withStart(-1);
    }
}
