<?php

namespace JiraRestApi\Test\ServiceDesk;

use JiraRestApi\Dumper;
use JiraRestApi\ServiceDesk\Attachment\AttachmentInterface;
use JiraRestApi\ServiceDesk\Attachment\TemporaryFileInterface;
use JiraRestApi\ServiceDesk\Date\DateInterface;
use JiraRestApi\ServiceDesk\Request\FieldValueInterface;
use JiraRestApi\ServiceDesk\Request\RequestInterface;
use JiraRestApi\ServiceDesk\RequestService;
use JiraRestApi\ServiceDesk\RequestServiceInterface;
use JiraRestApi\ServiceDesk\ServiceDeskService;
use JiraRestApi\ServiceDesk\User\UserInterface;
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
        $requestTypeId = (string) $_ENV['JIRA_SERVICE_DESK_REQUEST_TYPE_ID'];
        $accountId = $_ENV['JIRA_SERVICE_DESK_CUSTOMER_ID'];

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
    public function testCreateComment(RequestInterface $request)
    {
        $comment = $this->sut->createComment($request->getIssueId(), 'test comment', true);

        self::assertEquals('test comment', $comment->getBody());
        self::assertNotEmpty($comment->getId());
        self::assertNotNull($comment->getAuthor());
        self::assertTrue($comment->isPublic());
        self::assertTrue($comment->getCreated()->getEpochMillis() > 0);
        self::assertEquals((int) ($comment->getCreated()->getEpochMillis() / 1000), $comment->getCreated()->getDateTime()->getTimestamp());
    }

    /**
     * @return TemporaryFileInterface[]
     */
    public function testAttachTemporaryFile(): array
    {
        $serviceDeskService = new ServiceDeskService();

        $files = $serviceDeskService->attachTemporaryFile($this->serviceDeskId, [
            $this->getTestFilePath('test-attachment.png'),
            $this->getTestFilePath('test-attachment.txt'),
        ]);

        foreach ($files as $file) {
            assert($file instanceof TemporaryFileInterface);
            self::assertNotEmpty($file->getTemporaryAttachmentId());
        }
        self::assertEquals('test-attachment.png', $files[0]->getFileName());
        self::assertEquals('test-attachment.txt', $files[1]->getFileName());

        return $files;
    }

    /**
     * @depends testCreateRequest
     * @depends testAttachTemporaryFile
     *
     * @param RequestInterface $request
     * @param TemporaryFileInterface[] $files
     */
    public function testCreateAttachment(RequestInterface $request, array $files)
    {
        $fileIds = array_map(function (TemporaryFileInterface $file): string {
            return $file->getTemporaryAttachmentId();
        }, $files);

        $result = $this->sut->createAttachment($request->getIssueId(), $fileIds, true, 'foobar');

        self::assertTrue($result->getComment()->isPublic());
        self::assertStringContainsString('foobar', $result->getComment()->getBody());
        self::assertStringContainsString('test-attachment.png', $result->getComment()->getBody());
        self::assertStringContainsString('test-attachment.txt', $result->getComment()->getBody());

        /** @var AttachmentInterface[] $attachments */
        $attachments = $result->getAttachmentsQuery()->allPages()->current()->getItems();

        self::assertEquals('test-attachment.png', $attachments[0]->getFileName());
        self::assertEquals('image/png', $attachments[0]->getMimeType());
        self::assertGreaterThan(100, $attachments[0]->getSize());
        self::assertTrue($attachments[0]->getAuthor() instanceof UserInterface);
        self::assertTrue($attachments[0]->getCreated() instanceof DateInterface);

        self::assertEquals('test-attachment.txt', $attachments[1]->getFileName());
        self::assertEquals('text/plain', $attachments[1]->getMimeType());
        self::assertGreaterThan(10, $attachments[1]->getSize());
    }

    protected function getTestFilePath(string $name): string
    {
        return PROJECT_DIR . '/test-data/' . $name;
    }
}
