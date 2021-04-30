<?php

namespace JiraRestApi\ServiceDesk\RequestType;

/**
 * Request field value. RequestTypeFieldValueDTO from the JIRA Service Desk API.
 */
class FieldValue implements FieldValueInterface
{
    /**
     * @var string
     */
    protected $value;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var FieldValueInterface[]
     */
    protected $children = [];

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * @inheritDoc
     * @param FieldValueInterface[] $children
     */
    public function setChildren(array $children): void
    {
        $this->children = $children;
    }
}
