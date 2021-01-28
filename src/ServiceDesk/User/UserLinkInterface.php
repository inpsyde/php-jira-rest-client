<?php

namespace JiraRestApi\ServiceDesk\User;

/**
 * URLs for the customer record and related items. UserLinkDTO from the JIRA Service Desk API.
 */
interface UserLinkInterface
{
    /**
     * @return string
     */
    public function getSelf(): string;

    /**
     * @param string $self
     */
    public function setSelf(string $self): void;

    /**
     * Returns REST API URL for the customer.
     * @return string
     */
    public function getJiraRest(): string;

    /**
     * Sets REST API URL for the customer.
     * @param string $jiraRest
     */
    public function setJiraRest(string $jiraRest): void;
}