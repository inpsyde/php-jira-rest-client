<?php

namespace JiraRestApi\ServiceDesk\Attachment;

use JiraRestApi\Pagination\PaginatedQueryInterface;
use JiraRestApi\ServiceDesk\Comment\CommentInterface;

/**
 * Info about a comment with attachments. AttachmentCreateResultDTO from the JIRA Service Desk API.
 */
class AttachmentCreationResult implements AttachmentCreationResultInterface
{
    /** @var CommentInterface */
    protected $comment;

    /** @var PaginatedQueryInterface<AttachmentInterface> */
    protected $attachmentsQuery;

    /**
     * @param CommentInterface $comment
     * @param PaginatedQueryInterface<AttachmentInterface> $attachmentsQuery
     */
    public function __construct(CommentInterface $comment, PaginatedQueryInterface $attachmentsQuery)
    {
        $this->comment = $comment;
        $this->attachmentsQuery = $attachmentsQuery;
    }

    public function getComment(): CommentInterface
    {
        return $this->comment;
    }

    /**
     * @inheritDoc
     * @return PaginatedQueryInterface<AttachmentInterface>
     */
    public function getAttachmentsQuery(): PaginatedQueryInterface
    {
        return $this->attachmentsQuery;
    }
}
