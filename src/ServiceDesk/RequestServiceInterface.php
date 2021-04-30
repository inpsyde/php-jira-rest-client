<?php

namespace JiraRestApi\ServiceDesk;

use JiraRestApi\ServiceDesk\Attachment\AttachmentCreationResultInterface;
use JiraRestApi\ServiceDesk\Comment\CommentInterface;
use JiraRestApi\ServiceDesk\Request\RequestInterface;

/**
 * The interface for service desk request operations, matching the Request group in API.
 * @link https://developer.atlassian.com/cloud/jira/service-desk/rest/api-group-request
 */
interface RequestServiceInterface
{
    /**
     * Creates a customer request and returns the created request.
     * @param string|int $serviceDeskId ID of the service desk in which to create the request.
     * Must be a numeric ID, not key.
     * @param string|int $requestTypeId ID of the request type for the request.
     * @param array<string, mixed> $fieldValues Map of Jira field IDs and their values representing the content of the request.
     * @param string[]|null $requestParticipants List of customer accountIds to participate in the request.
     * @param string|null $raiseOnBehalfOf The accountId of the customer that the request is being raised on behalf of.
     * @return RequestInterface
     * @link https://developer.atlassian.com/cloud/jira/service-desk/rest/api-group-request/#api-rest-servicedeskapi-request-post
     */
    public function createRequest(
        $serviceDeskId,
        $requestTypeId,
        array $fieldValues,
        array $requestParticipants = null,
        string $raiseOnBehalfOf = null
    ): RequestInterface;

    /**
     * Creates a comment on a customer request and returns the created comment.
     * The current user recorded as the author of the comment.
     * @param string|int $issueIdOrKey The ID or key of the customer request to which the comment will be added.
     * @param string $body Content of the comment.
     * @param bool $public Indicates whether the comment is public (true) or private/internal (false).
     * @return CommentInterface
     * @link https://developer.atlassian.com/cloud/jira/service-desk/rest/api-group-request/#api-rest-servicedeskapi-request-issueidorkey-comment-post
     */
    public function createComment($issueIdOrKey, string $body, bool $public): CommentInterface;

    /**
     * Creates a comment with attachments.
     * The current user recorded as the author of the comment.
     * @param string|int $issueIdOrKey The ID or key of the customer request to which the attachment will be added.
     * @param string[] $temporaryAttachmentIds List of IDs for the temporary attachments to be added to the customer request.
     * @param bool $public Indicates whether the attachments are to be public (true) or private/internal (false).
     * @param string|null $additionalComment Content of the comment.
     * @link https://developer.atlassian.com/cloud/jira/service-desk/rest/api-group-request/#api-rest-servicedeskapi-request-issueidorkey-attachment-post
     */
    public function createAttachment(
        $issueIdOrKey,
        array $temporaryAttachmentIds,
        bool $public,
        string $additionalComment = null
    ): AttachmentCreationResultInterface;
}
