<?php

namespace JiraRestApi\ServiceDesk\RequestType;

/**
 * Request type info. RequestTypeDTO from the JIRA Service Desk API.
 */
interface RequestTypeInterface
{
    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @return string
     */
    public function getHelpText(): string;

    /**
     * Returns ID of the issue type the request type is based upon.
     * @return string
     */
    public function getIssueTypeId(): string;

    /**
     * Returns ID of the service desk the request type belongs to.
     * @return string
     */
    public function getServiceDeskId(): string;

    /**
     * Returns the request type groups the request type belongs to.
     * @return string[]
     */
    public function getGroupIds(): array;

    /**
     * Returns fields and additional metadata for creating a request that uses the request type.
     * @return RequestCreationMeta|null
     */
    public function getFields(): ?RequestCreationMeta;
}
