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
     * Returns if participants can be added to a request (true) or not.
     * @return bool
     */
    public function canAddRequestParticipants(): bool;

    /**
     * Returns the fields included in this request.
     * @return FieldInterface[]
     */
    public function getRequestTypeFields(): array;
}
