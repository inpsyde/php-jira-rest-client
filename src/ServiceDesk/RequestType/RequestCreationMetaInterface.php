<?php

namespace JiraRestApi\ServiceDesk\RequestType;

/**
 * Fields and additional metadata for creating a request of some type. CustomerRequestCreateMetaDTO from the JIRA Service Desk API.
 */
interface RequestCreationMetaInterface
{
    /**
     * Returns if a request can be raised on behalf of another user (true) or not.
     * @return bool
     */
    public function canRaiseOnBehalfOf(): bool;

    /**
     * Sets if a request can be raised on behalf of another user (true) or not.
     * @param bool $canRaiseOnBehalfOf
     */
    public function setCanRaiseOnBehalfOf(bool $canRaiseOnBehalfOf): void;

    /**
     * Returns if participants can be added to a request (true) or not.
     * @return bool
     */
    public function canAddRequestParticipants(): bool;

    /**
     * Sets if participants can be added to a request (true) or not.
     * @param bool $canAddRequestParticipants
     */
    public function setCanAddRequestParticipants(bool $canAddRequestParticipants): void;

    /**
     * Returns the fields included in this request.
     * @return FieldInterface[]
     */
    public function getRequestTypeFields(): array;

    /**
     * Sets the fields included in this request.
     * @param FieldInterface[] $requestTypeFields
     */
    public function setRequestTypeFields(array $requestTypeFields): void;
}