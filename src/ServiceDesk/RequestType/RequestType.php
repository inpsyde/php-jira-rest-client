<?php

namespace JiraRestApi\ServiceDesk\RequestType;

/**
 * Request type info. RequestTypeDTO from the JIRA Service Desk API.
 */
class RequestType implements RequestTypeInterface
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $helpText;

    /**
     * @var string
     */
    protected $issueTypeId;

    /**
     * @var string
     */
    protected $serviceDeskId;

    /**
     * @var string[]
     */
    protected $groupIds;

    /**
     * @var RequestCreationMeta
     */
    protected $fields;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getHelpText(): string
    {
        return $this->helpText;
    }

    public function setHelpText(string $helpText): void
    {
        $this->helpText = $helpText;
    }

    public function getIssueTypeId(): string
    {
        return $this->issueTypeId;
    }

    public function setIssueTypeId(string $issueTypeId): void
    {
        $this->issueTypeId = $issueTypeId;
    }

    public function getServiceDeskId(): string
    {
        return $this->serviceDeskId;
    }

    public function setServiceDeskId(string $serviceDeskId): void
    {
        $this->serviceDeskId = $serviceDeskId;
    }

    public function getGroupIds(): array
    {
        return $this->groupIds;
    }

    public function setGroupIds(array $groupIds): void
    {
        $this->groupIds = $groupIds;
    }

    public function getFields(): ?RequestCreationMeta
    {
        return $this->fields;
    }

    public function setFields(?RequestCreationMeta $fields): void
    {
        $this->fields = $fields;
    }
}
