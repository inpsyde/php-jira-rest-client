<?php

namespace JiraRestApi\ServiceDesk;


use JiraRestApi\ServiceDesk\User\UserInterface;

/**
 * The interface for service desk customer operations, matching the Customer group in API.
 * @link https://developer.atlassian.com/cloud/jira/service-desk/rest/api-group-customer
 */
interface CustomerServiceInterface
{
    /**
     * Adds a customer to the Jira Service Management and returns the created customer.
     * @param string $email Customer's email address. Must be unique.
     * @param string $displayName Customer's name for display in the UI. Does not need to be unique.
     * @return UserInterface
     * @link https://developer.atlassian.com/cloud/jira/service-desk/rest/api-group-customer/#api-rest-servicedeskapi-customer-post
     */
    public function createCustomer(string $email, string $displayName): UserInterface;
}