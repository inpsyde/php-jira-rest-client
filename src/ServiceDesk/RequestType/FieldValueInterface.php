<?php

namespace JiraRestApi\ServiceDesk\RequestType;

/**
 * Request field value. RequestTypeFieldValueDTO from the JIRA Service Desk API.
 */
interface FieldValueInterface
{
    /**
     * @return string
     */
    public function getValue(): string;

    /**
     * @return string
     */
    public function getLabel(): string;

    /**
     * @return FieldValueInterface[]
     */
    public function getChildren(): array;
}
