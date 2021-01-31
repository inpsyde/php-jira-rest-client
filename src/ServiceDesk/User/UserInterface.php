<?php

namespace JiraRestApi\ServiceDesk\User;

/**
 * User/customer info. UserDTO from the JIRA Service Desk API.
 */
interface UserInterface
{
    /**
     * Returns the unique identifier of the user across all Atlassian products.
     * @return string
     */
    public function getAccountId(): string;

    /**
     * Sets the unique identifier of the user across all Atlassian products.
     * @param string $accountId
     */
    public function setAccountId(string $accountId): void;

    /**
     * Returns the customer's email address. Depending on the customer’s privacy settings, this may be null.
     * @return string|null
     */
    public function getEmailAddress(): ?string;

    /**
     * Sets the customer's email address.
     * @param string|null $emailAddress
     */
    public function setEmailAddress(?string $emailAddress): void;

    /**
     * Returns the customer's name for display in a UI. Depending on the customer’s privacy settings, this may return an alternative value.
     * @return string
     */
    public function getDisplayName(): string;

    /**
     * Sets the customer's name for display in a UI.
     * @param string $displayName
     */
    public function setDisplayName(string $displayName): void;

    /**
     * Returns if the customer is active (true) or inactive (false).
     * @return bool
     */
    public function isActive(): bool;

    /**
     * Sets if the customer is active (true) or inactive (false).
     * @param bool $active
     */
    public function setActive(bool $active): void;

    /**
     * Returns the customer time zone. Depending on the customer’s privacy settings, this may be null.
     * @return string|null
     */
    public function getTimeZone(): ?string;

    /**
     * Sets the customer time zone.
     * @param string|null $timeZone
     */
    public function setTimeZone(?string $timeZone): void;
}
