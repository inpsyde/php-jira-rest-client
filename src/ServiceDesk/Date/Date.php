<?php

namespace JiraRestApi\ServiceDesk\Date;

/**
 * DateDTO from the JIRA Service Desk API.
 */
class Date implements DateInterface
{
    /** @var string */
    protected $iso8601;

    /** @var string */
    protected $jira;

    /** @var string */
    protected $friendly;

    /** @var int */
    protected $epochMillis;

    public function getIso8601(): string
    {
        return $this->iso8601;
    }

    public function setIso8601(string $iso8601): void
    {
        $this->iso8601 = $iso8601;
    }

    public function getJira(): string
    {
        return $this->jira;
    }

    public function setJira(string $jira): void
    {
        $this->jira = $jira;
    }

    public function getFriendly(): string
    {
        return $this->friendly;
    }

    public function setFriendly(string $friendly): void
    {
        $this->friendly = $friendly;
    }

    public function getEpochMillis(): int
    {
        return $this->epochMillis;
    }

    public function setEpochMillis(int $epochMillis): void
    {
        $this->epochMillis = $epochMillis;
    }

    public function getDateTime(): \DateTimeInterface
    {
        return \DateTime::createFromFormat('U', (string) (int) ($this->epochMillis / 1000));
    }
}
