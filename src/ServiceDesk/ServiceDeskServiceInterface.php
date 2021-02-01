<?php

namespace JiraRestApi\ServiceDesk;

use JiraRestApi\Pagination\PaginatedQueryInterface;
use JiraRestApi\ServiceDesk\RequestType\RequestTypeInterface;
use JiraRestApi\ServiceDesk\ServiceDesk\ServiceDeskInterface;
use JiraRestApi\ServiceDesk\User\UserInterface;

/**
 * The interface for service desk operations, matching the Servicedesk group in API.
 * @link https://developer.atlassian.com/cloud/jira/service-desk/rest/api-group-servicedesk
 */
interface ServiceDeskServiceInterface
{
    /**
     * Returns a paginated query object allowing to retrieve all service desks that the user has permission to access.
     * @return PaginatedQueryInterface<ServiceDeskInterface>
     * @link https://developer.atlassian.com/cloud/jira/service-desk/rest/api-group-servicedesk/#api-rest-servicedeskapi-servicedesk-get
     */
    public function getServiceDesks(): PaginatedQueryInterface;

    /**
     * Returns a paginated query object allowing to retrieve the customers with the specified query.
     * @param string|int $serviceDeskId The ID of the service desk the customer list are to be returned from.
     * This can alternatively be a project identifier. https://developer.atlassian.com/cloud/jira/service-desk/rest/intro/#request-language
     * @param string|null $query The string used to filter the customer list.
     * The parameter is matched against customers' displayName, name, or email.
     * For example, searching for "John", "Jo", or "Smith" will match a user with display name "John Smith".
     * @return PaginatedQueryInterface<UserInterface>
     * @link https://developer.atlassian.com/cloud/jira/service-desk/rest/api-group-servicedesk/#api-rest-servicedeskapi-servicedesk-servicedeskid-customer-get
     */
    public function getCustomers($serviceDeskId, string $query = null): PaginatedQueryInterface;

    /**
     * Adds one or more customers to a service desk.
     * If any of the passed customers are associated with the service desk, no changes will be made for those customers.
     * @param string|int $serviceDeskId The ID of the service desk.
     * This can alternatively be a project identifier. https://developer.atlassian.com/cloud/jira/service-desk/rest/intro/#request-language
     * @param string[] $accountIds List of user account IDs, to add to the service desk.
     * @link https://developer.atlassian.com/cloud/jira/service-desk/rest/api-group-servicedesk/#api-rest-servicedeskapi-servicedesk-servicedeskid-customer-post
     */
    public function addCustomers($serviceDeskId, array $accountIds): void;

    /**
     * Returns a paginated query object allowing to retrieve all customer request types from a service desk.
     * @param string|int $serviceDeskId The ID of the service desk the request types are to be returned from.
     * This can alternatively be a project identifier. https://developer.atlassian.com/cloud/jira/service-desk/rest/intro/#request-language
     * @param int|null $groupId Filters results to those in a customer request type group.
     * @param string|null $searchQuery The string used to filter the request types.
     * The parameter is matched against request types' name or description.
     * For example, the strings "Install", "Inst", "Equi", or "Equipment" will match a request type with the name "Equipment Installation Request".
     * @param string[]|null $expand The list of not loaded by default entities that should be included, such as "field".
     * @return PaginatedQueryInterface<RequestTypeInterface>
     * @link https://developer.atlassian.com/cloud/jira/service-desk/rest/api-group-servicedesk/#api-rest-servicedeskapi-servicedesk-servicedeskid-requesttype-get
     */
    public function getRequestTypes(
        $serviceDeskId,
        int $groupId = null,
        string $searchQuery = null,
        array $expand = null
    ): PaginatedQueryInterface;
}
