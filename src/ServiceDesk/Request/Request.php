<?php

namespace JiraRestApi\ServiceDesk\Request;

use JiraRestApi\ServiceDesk\Date\DateInterface;
use JiraRestApi\ServiceDesk\RequestType\RequestTypeInterface;
use JiraRestApi\ServiceDesk\ServiceDesk\ServiceDeskInterface;
use JiraRestApi\ServiceDesk\User\UserInterface;

/**
 * Request info. CustomerRequestDTO from the JIRA Service Desk API.
 *
 * The setters are used only for JSON mapping. We could the fields instead (even non-public)
 * but it may cause some confusion and accidental errors, because then we must use full namespace in PHPDoc.
 * https://github.com/inpsyde/php-jira-rest-client/pull/1#discussion_r597775525
 */
class Request implements RequestInterface
{
    /**
     * @var string
     */
    protected $issueId;

    /**
     * @var string
     */
    protected $issueKey;

    /**
     * @var string
     */
    protected $requestTypeId;

    /**
     * @var RequestTypeInterface|null
     */
    protected $requestType;

    /**
     * @var string
     */
    protected $serviceDeskId;

    /**
     * @var ServiceDeskInterface|null
     */
    protected $serviceDesk;

    /**
     * @var DateInterface
     */
    protected $createdDate;

    /**
     * @var UserInterface
     */
    protected $reporter;

    /**
     * @var FieldValueInterface[]
     */
    protected $requestFieldValues = [];

    /**
     * @var StatusInterface
     */
    protected $currentStatus;

    public function getIssueId(): string
    {
        return $this->issueId;
    }

    public function setIssueId(string $issueId): void
    {
        $this->issueId = $issueId;
    }

    public function getIssueKey(): string
    {
        return $this->issueKey;
    }

    public function setIssueKey(string $issueKey): void
    {
        $this->issueKey = $issueKey;
    }

    public function getRequestTypeId(): string
    {
        return $this->requestTypeId;
    }

    public function setRequestTypeId(string $requestTypeId): void
    {
        $this->requestTypeId = $requestTypeId;
    }

    public function getRequestType(): ?RequestTypeInterface
    {
        return $this->requestType;
    }

    public function setRequestType(?RequestTypeInterface $requestType): void
    {
        $this->requestType = $requestType;
    }

    public function getServiceDeskId(): string
    {
        return $this->serviceDeskId;
    }

    public function setServiceDeskId(string $serviceDeskId): void
    {
        $this->serviceDeskId = $serviceDeskId;
    }

    public function getServiceDesk(): ?ServiceDeskInterface
    {
        return $this->serviceDesk;
    }

    public function setServiceDesk(?ServiceDeskInterface $serviceDesk): void
    {
        $this->serviceDesk = $serviceDesk;
    }

    public function getCreatedDate(): DateInterface
    {
        return $this->createdDate;
    }

    public function setCreatedDate(DateInterface $createdDate): void
    {
        $this->createdDate = $createdDate;
    }

    public function getReporter(): UserInterface
    {
        return $this->reporter;
    }

    public function setReporter(UserInterface $reporter): void
    {
        $this->reporter = $reporter;
    }

    public function getRequestFieldValues(): array
    {
        return $this->requestFieldValues;
    }

    /**
     * @param FieldValueInterface[] $requestFieldValues
     */
    public function setRequestFieldValues(array $requestFieldValues): void
    {
        $this->requestFieldValues = $requestFieldValues;
    }

    public function getCurrentStatus(): StatusInterface
    {
        return $this->currentStatus;
    }

    public function setCurrentStatus(StatusInterface $currentStatus): void
    {
        $this->currentStatus = $currentStatus;
    }
}
