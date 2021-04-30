<?php

namespace JiraRestApi\ServiceDesk\Attachment;

use JiraRestApi\ServiceDesk\Date\DateInterface;
use JiraRestApi\ServiceDesk\User\UserInterface;

/**
 * Temporary file that was uploaded and can be used for attachments.
 */
class TemporaryFile implements TemporaryFileInterface
{
    /** @var string */
    protected $temporaryAttachmentId;

    /** @var string */
    protected $fileName;

    public function getTemporaryAttachmentId(): string
    {
        return $this->temporaryAttachmentId;
    }

    public function setTemporaryAttachmentId(string $temporaryAttachmentId): void
    {
        $this->temporaryAttachmentId = $temporaryAttachmentId;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): void
    {
        $this->fileName = $fileName;
    }
}
