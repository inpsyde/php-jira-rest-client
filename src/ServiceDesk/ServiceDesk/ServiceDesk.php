<?php

namespace JiraRestApi\ServiceDesk\ServiceDesk;

/**
 * Service desk info. ServiceDeskDTO from the JIRA Service Desk API.
 *
 * The setters are used only for JSON mapping (for consistency). We could the fields instead (even non-public)
 * but it may cause some confusion and accidental errors, because then we must use full namespace in PHPDoc.
 * https://github.com/inpsyde/php-jira-rest-client/pull/1#discussion_r597775525
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
