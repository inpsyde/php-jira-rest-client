<?php

namespace JiraRestApi\ServiceDesk\Request;

use JiraRestApi\ServiceDesk\Date\DateInterface;
use JiraRestApi\ServiceDesk\RequestType\RequestTypeInterface;
use JiraRestApi\ServiceDesk\ServiceDesk\ServiceDeskInterface;
use JiraRestApi\ServiceDesk\User\UserInterface;

/**
 * Request info. CustomerRequestDTO from the JIRA Service Desk API.
 */
interface RequestInterface
{
    /**
     * Returns ID of the request, as the peer issue ID.
     * @return string
     */
    public function getIssueId(): string;

    /**
     * Returns key of the request, as the peer issue key.
     * @return string
     */
    public function getIssueKey(): string;

    /**
     * Returns ID of the request type for the request.
     * @return string
     */
    public function getRequestTypeId(): string;

    /**
     * Returns the request type.
     * @return RequestTypeInterface|null
     */
    public function getRequestType(): ?RequestTypeInterface;

    /**
     * Returns ID of the service desk the request belongs to.
     * @return string
     */
    public function getServiceDeskId(): string;

    /**
     * Returns the service desk the request belongs to.
     * @return ServiceDeskInterface|null
     */
    public function getServiceDesk(): ?ServiceDeskInterface;

    /**
     * Returns date on which the request was created.
     * @return DateInterface
     */
    public function getCreatedDate(): DateInterface;

    /**
     * Returns the customer reporting the request.
     * @return UserInterface
     */
    public function getReporter(): UserInterface;

    /**
     * Returns Jira field IDs and their values representing the content of the request.
     * @return FieldValueInterface[]
     */
    public function getRequestFieldValues(): array;

    /**
     * Returns status of the request.
     * @return StatusInterface
     */
    public function getCurrentStatus(): StatusInterface;
}