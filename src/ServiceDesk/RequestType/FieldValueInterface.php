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
     * @param string $value
     */
    public function setValue(string $value): void;

    /**
     * @return string
     */
    public function getLabel(): string;

    /**
     * @param string $label
     */
    public function setLabel(string $label): void;

    /**
     * @return FieldValueInterface[]
     */
    public function getChildren(): array;

    /**
     * @param FieldValueInterface[] $children
     */
    public function setChildren(array $children): void;
}