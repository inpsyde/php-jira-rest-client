<?php

namespace JiraRestApi\ServiceDesk\User;

/**
 * User/customer info. UserDTO from the JIRA Service Desk API.
 */
class User implements UserInterface
{
    /**
     * @var string
     */
    protected $accountId;

    /**
     * @var string
     */
    protected $emailAddress;

    /**
     * @var string
     */
    protected $displayName;

    /**
     * @var bool
     */
    protected $active;

    /**
     * @var string
     */
    protected $timeZone;

    /**
     * @var UserLinkInterface
     */
    protected $links;

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function setAccountId(string $accountId): void
    {
        $this->accountId = $accountId;
    }

    public function getEmailAddress(): ?string
    {
        return $this->emailAddress;
    }

    public function setEmailAddress(?string $emailAddress): void
    {
        $this->emailAddress = $emailAddress;
    }

    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    public function setDisplayName(string $displayName): void
    {
        $this->displayName = $displayName;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    public function getTimeZone(): ?string
    {
        return $this->timeZone;
    }

    public function setTimeZone(?string $timeZone): void
    {
        $this->timeZone = $timeZone;
    }

    public function getLinks(): UserLinkInterface
    {
        return $this->links;
    }

    public function setLinks(UserLinkInterface $links): void
    {
        $this->links = $links;
    }
}