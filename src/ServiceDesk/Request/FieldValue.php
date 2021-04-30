<?php

namespace JiraRestApi\ServiceDesk\Request;

/**
 * Request field value. CustomerRequestFieldValueDTO from the JIRA Service Desk API.
 */
class FieldValue implements FieldValueInterface
{
    /**
     * @var string
     */
    protected $fieldId;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var object
     */
    protected $renderedValue;

    public function getFieldId(): string
    {
        return $this->fieldId;
    }

    public function setFieldId(string $fieldId): void
    {
        $this->fieldId = $fieldId;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value): void
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

    public function getRenderedValue()
    {
        return $this->renderedValue;
    }

    public function setRenderedValue($renderedValue): void
    {
        $this->renderedValue = $renderedValue;
    }

}
