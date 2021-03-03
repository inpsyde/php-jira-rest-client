<?php

namespace JiraRestApi\ServiceDesk\RequestType;

/**
 * Request field info. RequestTypeFieldDTO from the JIRA Service Desk API.
 */
interface FieldInterface
{
    /**
     * @return string
     */
    public function getFieldId(): string;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @return bool
     */
    public function isRequired(): bool;

    /**
     * @return bool
     */
    public function isVisible(): bool;

    /**
     * @return FieldValueInterface[]
     */
    public function getDefaultValues(): array;

    /**
     * @return FieldValueInterface[]
     */
    public function getValidValues(): array;
}
