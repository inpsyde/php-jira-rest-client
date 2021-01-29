<?php

namespace JiraRestApi\ServiceDesk\ServiceDesk;


/**
 * Service desk info. ServiceDeskDTO from the JIRA Service Desk API.
 */
interface ServiceDeskInterface
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
    public function getProjectId(): string;

    /**
     * @param string $projectId
     */
    public function setProjectId(string $projectId): void;

    /**
     * @return string
     */
    public function getProjectName(): string;

    /**
     * @param string $projectName
     */
    public function setProjectName(string $projectName): void;

    /**
     * @return string
     */
    public function getProjectKey(): string;

    /**
     * @param string $projectKey
     */
    public function setProjectKey(string $projectKey): void;
}
