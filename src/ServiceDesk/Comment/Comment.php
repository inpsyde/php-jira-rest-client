<?php

namespace JiraRestApi\ServiceDesk\Comment;

use JiraRestApi\ServiceDesk\Date\DateInterface;
use JiraRestApi\ServiceDesk\User\UserInterface;

/**
 * Comment in a customer request. CommentDTO from the JIRA Service Desk API.
 *
 * The setters are used only for JSON mapping. We could the fields instead (even non-public)
 * but it may cause some confusion and accidental errors, because then we must use full namespace in PHPDoc.
 * https://github.com/inpsyde/php-jira-rest-client/pull/1#discussion_r597775525
 */
class Comment implements CommentInterface
{
    /** @var string */
    protected $id;

    /** @var string */
    protected $body;

    /** @var bool */
    protected $public;

    /** @var UserInterface */
    protected $author;

    /** @var DateInterface */
    protected $created;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    public function isPublic(): bool
    {
        return $this->public;
    }

    public function setPublic(bool $public): void
    {
        $this->public = $public;
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
}
