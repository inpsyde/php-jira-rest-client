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
     * @return string
     */
    public function getProjectId(): string;

    /**
     * @return string
     */
    public function getProjectName(): string;

    /**
     * @return string
     */
    public function getProjectKey(): string;
}
