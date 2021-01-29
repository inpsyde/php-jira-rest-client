<?php

namespace JiraRestApi\ServiceDesk\ServiceDesk;

use JiraRestApi\ServiceDesk\Link\SelfLinkInterface;

/**
 * Service desk info. ServiceDeskDTO from the JIRA Service Desk API.
 */
interface ServiceDeskInterface
{
    /**
     * @return SelfLinkInterface
     */
    public function getLinks(): SelfLinkInterface;

    /**
     * @param string $projectName
     */
    public function setProjectName(string $projectName): void;

    /**
     * @return string
     */
    public function getProjectId(): string;

    /**
     * @param string $projectKey
     */
    public function setProjectKey(string $projectKey): void;

    /**
     * @return string
     */
    public function getProjectKey(): string;

    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return string
     */
    public function getProjectName(): string;

    /**
     * @param SelfLinkInterface $links
     */
    public function setLinks(SelfLinkInterface $links): void;

    /**
     * @param string $projectId
     */
    public function setProjectId(string $projectId): void;

    /**
     * @param string $id
     */
    public function setId(string $id): void;
}
