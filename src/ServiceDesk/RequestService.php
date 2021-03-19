<?php

namespace JiraRestApi\ServiceDesk;

use JiraRestApi\Configuration\ConfigurationInterface;
use JiraRestApi\JiraClient;
use JiraRestApi\JsonOperationsTrait;
use JiraRestApi\Pagination\PaginatedQuery;
use JiraRestApi\ServiceDesk\Attachment\Attachment;
use JiraRestApi\ServiceDesk\Attachment\AttachmentCreationResult;
use JiraRestApi\ServiceDesk\Attachment\AttachmentCreationResultInterface;
use JiraRestApi\ServiceDesk\Attachment\AttachmentInterface;
use JiraRestApi\ServiceDesk\Comment\Comment;
use JiraRestApi\ServiceDesk\Comment\CommentInterface;
use JiraRestApi\ServiceDesk\Date\Date;
use JiraRestApi\ServiceDesk\Date\DateInterface;
use JiraRestApi\ServiceDesk\Request\FieldValue;
use JiraRestApi\ServiceDesk\Request\FieldValueInterface;
use JiraRestApi\ServiceDesk\Request\Request;
use JiraRestApi\ServiceDesk\Request\RequestInterface;
use JiraRestApi\ServiceDesk\Request\Status;
use JiraRestApi\ServiceDesk\Request\StatusInterface;
use JiraRestApi\ServiceDesk\RequestType\Field;
use JiraRestApi\ServiceDesk\RequestType\FieldInterface;
use JiraRestApi\ServiceDesk\RequestType\FieldValue as RequestTypeFieldValue;
use JiraRestApi\ServiceDesk\RequestType\FieldValueInterface as RequestTypeFieldValueInterface;
use JiraRestApi\ServiceDesk\RequestType\RequestCreationMeta;
use JiraRestApi\ServiceDesk\RequestType\RequestCreationMetaInterface;
use JiraRestApi\ServiceDesk\RequestType\RequestType;
use JiraRestApi\ServiceDesk\RequestType\RequestTypeInterface;
use JiraRestApi\ServiceDesk\ServiceDesk\ServiceDesk;
use JiraRestApi\ServiceDesk\ServiceDesk\ServiceDeskInterface;
use JiraRestApi\ServiceDesk\User\User;
use JiraRestApi\ServiceDesk\User\UserInterface;
use JiraRestApi\ServiceDeskTrait;
use Psr\Log\LoggerInterface;

/**
 * The interface for service desk request operations, matching the Request group in API.
 * @link https://developer.atlassian.com/cloud/jira/service-desk/rest/api-group-request
 */
class RequestService extends JiraClient implements RequestServiceInterface
{
    use ServiceDeskTrait;
    use JsonOperationsTrait;

    protected $uri = '/request';

    protected $classMap = [
        UserInterface::class => User::class,
        DateInterface::class => Date::class,
        FieldValueInterface::class => FieldValue::class,
        StatusInterface::class => Status::class,
        ServiceDeskInterface::class => ServiceDesk::class,
        RequestTypeInterface::class => RequestType::class,
        RequestCreationMetaInterface::class => RequestCreationMeta::class,
        FieldInterface::class => Field::class,
        RequestTypeFieldValueInterface::class => RequestTypeFieldValue::class,
    ];

    public function __construct(ConfigurationInterface $configuration = null, LoggerInterface $logger = null, $path = './')
    {
        parent::__construct($configuration, $logger, $path);

        $this->setupAPIUri();
    }

    /**
     * @inheritDoc
     */
    public function createRequest(
        $serviceDeskId,
        $requestTypeId,
        array $fieldValues,
        array $requestParticipants = null,
        ?string $raiseOnBehalfOf = null
    ): RequestInterface
    {
        $data = $this->encodeJson(array_filter([
            'serviceDeskId' => (string) $serviceDeskId,
            'requestTypeId' => (string) $requestTypeId,
            'requestFieldValues' => $fieldValues,
            'requestParticipants' => $requestParticipants,
            'raiseOnBehalfOf' => $raiseOnBehalfOf,
        ], function ($val) { return $val !== null; }));

        $ret = $this->exec($this->uri, $data);

        return $this->prepareJsonMapper($this->classMap)->map(
            $this->decodeJson($ret),
            new Request()
        );
    }

    /**
     * @inheritDoc
     */
    public function createComment($issueIdOrKey, string $body, bool $public): CommentInterface
    {
        $data = $this->encodeJson(['body' => $body, 'public' => $public]);

        $ret = $this->exec($this->issueUri($issueIdOrKey) . '/comment', $data);

        return $this->prepareJsonMapper($this->classMap)->map(
            $this->decodeJson($ret),
            new Comment()
        );
    }

    public function createAttachment(
        $issueIdOrKey,
        array $temporaryAttachmentIds,
        bool $public,
        string $additionalComment = null
    ): AttachmentCreationResultInterface
    {
        $data = ['temporaryAttachmentIds' => $temporaryAttachmentIds, 'public' => $public];
        if ($additionalComment) {
            $data['additionalComment'] = ['body' => $additionalComment];
        }

        $ret = $this->exec($this->issueUri($issueIdOrKey) . '/attachment', $this->encodeJson($data));

        $result = $this->decodeJson($ret);

        /** @var Comment $comment */
        $comment = $this->prepareJsonMapper($this->classMap)->map($result->comment, new Comment());

        return new AttachmentCreationResult(
            $comment,
            new PaginatedQuery(function (array $paginationQuery) use ($issueIdOrKey, $comment) {
                $this->allowExperimentalApi();

                $response = $this->exec($this->issueUri($issueIdOrKey) . '/comment/' . $comment->getId() . '/attachment'
                    . '?' . http_build_query($paginationQuery));
                return $this->decodeJson($response);
            }, function ($itemData): AttachmentInterface {
                return $this->prepareJsonMapper($this->classMap)->map($itemData, new Attachment());
            }, $result->attachments)
        );
    }

    protected function issueUri(string $id): string {
        return $this->uri . "/$id";
    }
}
