<?php

namespace JiraRestApi\ServiceDesk\Request;

use JiraRestApi\ServiceDesk\Date\DateInterface;

/**
 * Request status info. CustomerRequestStatusDTO from the JIRA Service Desk API.
 */
class Status implements StatusInterface
{
    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $statusCategory;

    /**
     * @var DateInterface
     */
    protected $statusDate;

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getStatusCategory(): string
    {
        return $this->statusCategory;
    }

    public function setStatusCategory(string $statusCategory): void
    {
        $this->statusCategory = $statusCategory;
    }

    public function getStatusDate(): DateInterface
    {
        return $this->statusDate;
    }

    public function setStatusDate(DateInterface $statusDate): void
    {
        $this->statusDate = $statusDate;
    }
}
