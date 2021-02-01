<?php

namespace JiraRestApi\Test\ServiceDesk;

use JiraRestApi\ServiceDesk\RequestService;
use JiraRestApi\ServiceDesk\RequestServiceInterface;
use PHPUnit\Framework\TestCase;

class RequestServiceTest extends TestCase
{
    /**
     * @var RequestServiceInterface
     */
    protected $sut;

    protected $issueId;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        if (!array_key_exists('JIRA_SERVICE_DESK_ID', $_ENV)) {
            echo PHP_EOL . 'Fill the values in .env.phpunit for Service Desk tests' . PHP_EOL;
            self::markTestSkipped();
        }
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->sut = new RequestService();

        $this->issueId = (string) $_ENV['JIRA_SERVICE_DESK_ISSUE_ID'];
    }

    public function testAddComment()
    {
        $comment = $this->sut->addComment($this->issueId, 'test comment', true);

        self::assertEquals('test comment', $comment->getBody());
        self::assertNotEmpty($comment->getId());
        self::assertNotNull($comment->getAuthor());
        self::assertTrue($comment->isPublic());
        self::assertTrue($comment->getCreated()->getEpochMillis() > 0);
        self::assertEquals((int) ($comment->getCreated()->getEpochMillis() / 1000), $comment->getCreated()->getDateTime()->getTimestamp());
    }
}
