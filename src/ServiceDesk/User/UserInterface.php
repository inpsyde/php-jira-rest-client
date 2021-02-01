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
     * Returns the customer's email address. Depending on the customer’s privacy settings, this may be null.
     * @return string|null
     */
    public function getEmailAddress(): ?string;

    /**
     * Returns the customer's name for display in a UI. Depending on the customer’s privacy settings, this may return an alternative value.
     * @return string
     */
    public function getDisplayName(): string;

    /**
     * Returns if the customer is active (true) or inactive (false).
     * @return bool
     */
    public function isActive(): bool;

    /**
     * Returns the customer time zone. Depending on the customer’s privacy settings, this may be null.
     * @return string|null
     */
    public function getTimeZone(): ?string;
}
