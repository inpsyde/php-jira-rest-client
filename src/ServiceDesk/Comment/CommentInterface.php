<?php

namespace JiraRestApi\ServiceDesk\Comment;

use JiraRestApi\ServiceDesk\Date\DateInterface;
use JiraRestApi\ServiceDesk\User\UserInterface;

/**
 * Comment in a customer request. CommentDTO from the JIRA Service Desk API.
 */
interface CommentInterface
{
    /**
     * Returns ID of the comment.
     * @return string
     */
    public function getId(): string;

    /**
     * Returns content of the comment.
     * @return string
     */
    public function getBody(): string;

    /**
     * Returns whether the comment is public (true) or private/internal (false).
     * @return bool
     */
    public function isPublic(): bool;

    /**
     * Returns the customer who authored the comment.
     * @return UserInterface
     */
    public function getAuthor(): UserInterface;

    /**
     * Returns the date the comment was created.
     * @return DateInterface
     */
    public function getCreated(): DateInterface;
}