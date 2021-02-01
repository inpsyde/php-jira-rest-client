<?php

namespace JiraRestApi\ServiceDesk;

use JiraRestApi\ServiceDesk\Comment\CommentInterface;

/**
 * The interface for service desk request operations, matching the Request group in API.
 * @link https://developer.atlassian.com/cloud/jira/service-desk/rest/api-group-request
 */
interface RequestServiceInterface
{
    /**
     * Creates a comment on a customer request and returns the created comment.
     * The current user recorded as the author of the comment.
     * @param string|int $issueIdOrKey The ID or key of the customer request to which the comment will be added.
     * @param string $body Content of the comment.
     * @param bool $public Indicates whether the comment is public (true) or private/internal (false).
     * @return CommentInterface
     * @link https://developer.atlassian.com/cloud/jira/service-desk/rest/api-group-request/#api-rest-servicedeskapi-request-issueidorkey-comment-post
     */
    public function addComment($issueIdOrKey, string $body, bool $public): CommentInterface;
}
