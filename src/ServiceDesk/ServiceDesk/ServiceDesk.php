<?php

namespace JiraRestApi\ServiceDesk\ServiceDesk;

/**
 * Service desk info. ServiceDeskDTO from the JIRA Service Desk API.
 */
class ServiceDesk implements ServiceDeskInterface
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $projectId;

    /**
     * @var string
     */
    protected $projectName;

    /**
     * @var string
     */
    protected $projectKey;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getProjectId(): string
    {
        return $this->projectId;
    }

    public function setProjectId(string $projectId): void
    {
        $this->projectId = $projectId;
    }

    public function getProjectName(): string
    {
        return $this->projectName;
    }

    public function setProjectName(string $projectName): void
    {
        $this->projectName = $projectName;
    }

    public function getProjectKey(): string
    {
        return $this->projectKey;
    }

    public function setProjectKey(string $projectKey): void
    {
        $this->projectKey = $projectKey;
    }
}
