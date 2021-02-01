<?php

namespace JiraRestApi\Test\ServiceDesk;

use JiraRestApi\ServiceDesk\Request\FieldValueInterface;
use JiraRestApi\ServiceDesk\Request\RequestInterface;
use JiraRestApi\ServiceDesk\RequestService;
use JiraRestApi\ServiceDesk\RequestServiceInterface;
use JiraRestApi\ServiceDesk\ServiceDeskService;
use PHPUnit\Framework\TestCase;

class RequestServiceTest extends TestCase
{
    /**
     * @var RequestServiceInterface
     */
    protected $sut;

    protected $serviceDeskId;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        if (!array_key_exists('JIRA_SERVICE_DESK_NUMERIC_ID', $_ENV)) {
            echo PHP_EOL . 'Fill the values in .env.phpunit for Service Desk tests' . PHP_EOL;
            self::markTestSkipped();
        }
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->sut = new RequestService();

        $this->serviceDeskId = (string) $_ENV['JIRA_SERVICE_DESK_NUMERIC_ID'];
    }

    public function testCreateRequest(): RequestInterface
    {
        $serviceDeskService = new ServiceDeskService();

        $requestType = $serviceDeskService->getRequestTypes($this->serviceDeskId)->withLimit(1)->execute()->getItems()[0];
        $customer = $serviceDeskService->getCustomers($this->serviceDeskId)->withStart(1)->withLimit(1)->execute()->getItems()[0];
        $requestTypeId = $requestType->getId();
        $accountId = $customer->getAccountId();

        $request = $this->sut->createRequest(
            $this->serviceDeskId,
            $requestTypeId,
            [
                'summary' => 'Test request title',
                'description' => 'Test request text.',
            ],
            [$accountId],
            $accountId
        );

        self::assertEquals($this->serviceDeskId, $request->getServiceDeskId());
        self::assertEquals((string) $requestTypeId, $request->getRequestTypeId());
        self::assertNotEmpty($request->getIssueKey());
        self::assertNotEmpty($request->getCurrentStatus()->getStatusCategory());

        $summaryField = array_values(array_filter($request->getRequestFieldValues(), function (FieldValueInterface $field) {
            return $field->getFieldId() === 'summary';
        }))[0];
        $descriptionField = array_values(array_filter($request->getRequestFieldValues(), function (FieldValueInterface $field) {
            return $field->getFieldId() === 'description';
        }))[0];

        self::assertEquals('Test request title', $summaryField->getValue());
        self::assertEquals('Test request text.', $descriptionField->getValue());

        return $request;
    }

    /**
     * @depends testCreateRequest
     */
    public function testAddComment(RequestInterface $request)
    {
        $comment = $this->sut->addComment($request->getIssueId(), 'test comment', true);

        self::assertEquals('test comment', $comment->getBody());
        self::assertNotEmpty($comment->getId());
        self::assertNotNull($comment->getAuthor());
        self::assertTrue($comment->isPublic());
        self::assertTrue($comment->getCreated()->getEpochMillis() > 0);
        self::assertEquals((int) ($comment->getCreated()->getEpochMillis() / 1000), $comment->getCreated()->getDateTime()->getTimestamp());
    }
}
