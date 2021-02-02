<?php

namespace JiraRestApi\ServiceDesk\Attachment;

use JiraRestApi\ServiceDesk\Date\DateInterface;
use JiraRestApi\ServiceDesk\User\UserInterface;

/**
 * Attachment in a customer request. AttachmentDTO from the JIRA Service Desk API.
 */
class Attachment implements AttachmentInterface
{
    /** @var string */
    protected $fileName;

    /** @var UserInterface */
    protected $author;

    /** @var DateInterface */
    protected $created;

    /** @var int */
    protected $size;

    /** @var string */
    protected $mimeType;

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function setFilename(string $fileName): void
    {
        $this->fileName = $fileName;
    }

    public function getAuthor(): UserInterface
    {
        return $this->author;
    }

    public function setAuthor(UserInterface $author): void
    {
        $this->author = $author;
    }

    public function getCreated(): DateInterface
    {
        return $this->created;
    }

    public function setCreated(DateInterface $created): void
    {
        $this->created = $created;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function setSize(int $size): void
    {
        $this->size = $size;
    }

    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    public function setMimeType(string $mimeType): void
    {
        $this->mimeType = $mimeType;
    }
}
