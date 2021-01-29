<?php

namespace JiraRestApi\ServiceDesk;

use JiraRestApi\Pagination\PaginatedQueryInterface;
use JiraRestApi\ServiceDesk\ServiceDesk\ServiceDeskInterface;
use JiraRestApi\ServiceDesk\User\UserInterface;

/**
 * The interface for service desk operations, matching the Servicedesk group in API.
 * @see https://developer.atlassian.com/cloud/jira/service-desk/rest/api-group-servicedesk
 */
interface ServiceDeskServiceInterface
{
    /**
     * Returns a paginated query object allowing to retrieve all service desks that the user has permission to access.
     * @return PaginatedQueryInterface<ServiceDeskInterface>
     */
    public function getServiceDesks(): PaginatedQueryInterface;

    /**
     * Returns a paginated query object allowing to retrieve the customers with the specified query.
     * @param string $serviceDeskId The ID of the service desk the customer list should be returned from.
     * This can alternatively be a project identifier. https://developer.atlassian.com/cloud/jira/service-desk/rest/intro/#request-language
     * @param string|null $query The string used to filter the customer list.
     * The parameter is matched against customers' displayName, name, or email.
     * For example, searching for "John", "Jo", or "Smith" will match a user with display name "John Smith".
     * @return PaginatedQueryInterface<UserInterface>
     */
    public function getCustomers(string $serviceDeskId, string $query = null): PaginatedQueryInterface;
}
