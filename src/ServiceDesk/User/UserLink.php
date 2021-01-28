<?php

namespace JiraRestApi\ServiceDesk\User;

/**
 * URLs for the customer record and related items. UserLinkDTO from the JIRA Service Desk API.
 */
class UserLink implements UserLinkInterface
{
    /**
     * @var string
     */
    protected $self;

    /**
     * @var string
     */
    protected $jiraRest;

    public function getSelf(): string
    {
        return $this->self;
    }

    public function setSelf(string $self): void
    {
        $this->self = $self;
    }

    public function getJiraRest(): string
    {
        return $this->jiraRest;
    }

    public function setJiraRest(string $jiraRest): void
    {
        $this->jiraRest = $jiraRest;
    }
}
