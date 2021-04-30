<?php

namespace JiraRestApi\ServiceDesk\Attachment;

use JiraRestApi\ServiceDesk\Date\DateInterface;
use JiraRestApi\ServiceDesk\User\UserInterface;

/**
 * Attachment in a customer request. AttachmentDTO from the JIRA Service Desk API.
 */
interface AttachmentInterface
{
    /**
     * @return string
     */
    public function getFileName(): string;

    /**
     * @return UserInterface
     */
    public function getAuthor(): UserInterface;

    /**
     * Returns date the attachment was added.
     * @return DateInterface
     */
    public function getCreated(): DateInterface;

    /**
     * Returns size of the attachment in bytes.
     * @return int
     */
    public function getSize(): int;

    /**
     * Returns MIME type of the attachment.
     * @return string
     */
    public function getMimeType(): string;
}
