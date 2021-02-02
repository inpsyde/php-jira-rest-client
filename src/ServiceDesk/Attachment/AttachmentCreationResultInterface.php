<?php

namespace JiraRestApi\ServiceDesk\Attachment;

use JiraRestApi\Pagination\PaginatedQueryInterface;
use JiraRestApi\ServiceDesk\Comment\CommentInterface;

/**
 * Info about a comment with attachments. AttachmentCreateResultDTO from the JIRA Service Desk API.
 */
interface AttachmentCreationResultInterface
{
    /**
     * Returns the comment included with the attachments.
     * @return CommentInterface
     */
    public function getComment(): CommentInterface;

    /**
     * Returns paginated query allowing to retrieve info about all attachments.
     * @return PaginatedQueryInterface<AttachmentInterface>
     */
    public function getAttachmentsQuery(): PaginatedQueryInterface;
}