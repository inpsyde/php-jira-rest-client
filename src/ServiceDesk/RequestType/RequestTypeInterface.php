<?php

namespace JiraRestApi\ServiceDesk\RequestType;

use JiraRestApi\ServiceDesk\Link\SelfLinkInterface;

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
     * @param string $id
     */
    public function setId(string $id): void;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     */
    public function setName(string $name): void;

    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @param string $description
     */
    public function setDescription(string $description): void;

    /**
     * @return string
     */
    public function getHelpText(): string;

    /**
     * @param string $helpText
     */
    public function setHelpText(string $helpText): void;

    /**
     * Returns ID of the issue type the request type is based upon.
     * @return string
     */
    public function getIssueTypeId(): string;

    /**
     * Sets ID of the issue type the request type is based upon.
     * @param string $issueTypeId
     */
    public function setIssueTypeId(string $issueTypeId): void;

    /**
     * Returns ID of the service desk the request type belongs to.
     * @return string
     */
    public function getServiceDeskId(): string;

    /**
     * Sets ID of the service desk the request type belongs to.
     * @param string $serviceDeskId
     */
    public function setServiceDeskId(string $serviceDeskId): void;

    /**
     * Returns the request type groups the request type belongs to.
     * @return string[]
     */
    public function getGroupIds(): array;

    /**
     * Sets the request type groups the request type belongs to.
     * @param string[] $groupIds
     */
    public function setGroupIds(array $groupIds): void;

    /**
     * Returns fields and additional metadata for creating a request that uses the request type.
     * @return RequestCreationMeta|null
     */
    public function getFields(): ?RequestCreationMeta;

    /**
     * Sets fields and additional metadata for creating a request that uses the request type.
     * @param RequestCreationMeta|null $fields
     */
    public function setFields(?RequestCreationMeta $fields): void;

    /**
     * @return SelfLinkInterface
     */
    public function getLinks(): SelfLinkInterface;

    /**
     * @param SelfLinkInterface $links
     */
    public function setLinks(SelfLinkInterface $links): void;
}