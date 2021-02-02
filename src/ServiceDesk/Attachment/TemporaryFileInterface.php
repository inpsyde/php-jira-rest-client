<?php

namespace JiraRestApi\ServiceDesk\Attachment;

/**
 * Temporary file that was uploaded and can be used for attachments.
 */
interface TemporaryFileInterface
{
    public function getTemporaryAttachmentId(): string;

    public function getFileName(): string;
}