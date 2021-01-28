<?php

namespace JiraRestApi\ServiceDesk;

use JiraRestApi\Pagination\PaginatedQueryInterface;
use JiraRestApi\ServiceDesk\User\User;

/**
 * The interface for service desk operations, matching the Servicedesk group in API.
 * @see https://developer.atlassian.com/cloud/jira/service-desk/rest/api-group-servicedesk
 */
interface ServiceDeskServiceInterface
{
    /**
     * Returns a paginated query object allowing to retrieve the customers with the specified query.
     * @param int $serviceDeskId
     * @param string|null $query The string used to filter the customer list.
     * The parameter is matched against customers' displayName, name, or email.
     * For example, searching for "John", "Jo", or "Smith" will match a user with display name "John Smith".
     * @return PaginatedQueryInterface<User>
     */
    public function getCustomers(int $serviceDeskId, string $query = null): PaginatedQueryInterface;
}
