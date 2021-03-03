<?php

namespace JiraRestApi\ServiceDesk\Request;


use JiraRestApi\ServiceDesk\Date\DateInterface;

/**
 * Request status info. CustomerRequestStatusDTO from the JIRA Service Desk API.
 */
interface StatusInterface
{
    /**
     * Returns name of the status condition.
     * @return string
     */
    public function getStatus(): string;

    /**
     * Returns status category the status belongs to. One of StatusCategory constants,
     * @return string
     */
    public function getStatusCategory(): string;

    /**
     * Returns date on which the status was attained.
     * @return DateInterface
     */
    public function getStatusDate(): DateInterface;
}
