<?php

namespace JiraRestApi\ServiceDesk\Link;

/**
 * URL of the record. SelfLinkDTO from the JIRA Service Desk API.
 */
interface SelfLinkInterface
{
    /**
     * @return string
     */
    public function getSelf(): string;

    /**
     * @param string $self
     */
    public function setSelf(string $self): void;
}