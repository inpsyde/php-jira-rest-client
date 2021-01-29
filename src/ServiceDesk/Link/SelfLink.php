<?php

namespace JiraRestApi\ServiceDesk\Link;

/**
 * URL of the record. SelfLinkDTO from the JIRA Service Desk API.
 */
class SelfLink implements SelfLinkInterface
{
    /**
     * @var string
     */
    protected $self;

    public function getSelf(): string
    {
        return $this->self;
    }

    public function setSelf(string $self): void
    {
        $this->self = $self;
    }
}