<?php

namespace JiraRestApi\ServiceDesk\Date;

/**
 * DateDTO from the JIRA Service Desk API.
 */
interface DateInterface
{
    /**
     * Returns date in ISO8601 format.
     * @return string
     */
    public function getIso8601(): string;

    /**
     * Returns date in the format used in the Jira REST APIs, which is ISO8601 format but extended with milliseconds.
     * For example, 2016-09-28T23:08:32.097+1000.
     * @return string
     */
    public function getJira(): string;

    /**
     * Returns date in a user-friendly text format.
     * @return string
     */
    public function getFriendly(): string;

    /**
     * Returns date as the number of milliseconds that have elapsed since 00:00:00 UTC, 1 January 1970.
     * @return int
     */
    public function getEpochMillis(): int;

    /**
     * Returns PHP DateTime
     * @return \DateTimeInterface
     */
    public function getDateTime(): \DateTimeInterface;

}