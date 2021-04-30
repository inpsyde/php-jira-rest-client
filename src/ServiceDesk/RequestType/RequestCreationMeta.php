<?php

namespace JiraRestApi\ServiceDesk\RequestType;

/**
 * Fields and additional metadata for creating a request of some type. CustomerRequestCreateMetaDTO from the JIRA Service Desk API.
 */
class RequestCreationMeta implements RequestCreationMetaInterface
{
    /**
     * @var boolean
     */
    protected $canRaiseOnBehalfOf;

    /**
     * @var boolean
     */
    protected $canAddRequestParticipants;

    /**
     * @var FieldInterface[]
     */
    protected $requestTypeFields = [];

    public function canRaiseOnBehalfOf(): bool
    {
        return $this->canRaiseOnBehalfOf;
    }

    public function setCanRaiseOnBehalfOf(bool $canRaiseOnBehalfOf): void
    {
        $this->canRaiseOnBehalfOf = $canRaiseOnBehalfOf;
    }

    public function canAddRequestParticipants(): bool
    {
        return $this->canAddRequestParticipants;
    }

    public function setCanAddRequestParticipants(bool $canAddRequestParticipants): void
    {
        $this->canAddRequestParticipants = $canAddRequestParticipants;
    }

    public function getRequestTypeFields(): array
    {
        return $this->requestTypeFields;
    }

    /**
     * @inheritDoc
     * @param FieldInterface[] $requestTypeFields
     */
    public function setRequestTypeFields(array $requestTypeFields): void
    {
        $this->requestTypeFields = $requestTypeFields;
    }
}
