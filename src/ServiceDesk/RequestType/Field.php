<?php

namespace JiraRestApi\ServiceDesk\RequestType;

/**
 * Request field info. RequestTypeFieldDTO from the JIRA Service Desk API.
 */
class Field implements FieldInterface
{
    /**
     * @var string
     */
    protected $fieldId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var boolean
     */
    protected $required;

    /**
     * @var boolean
     */
    protected $visible;

    /**
     * @var FieldValueInterface[]
     */
    protected $defaultValues = [];

    /**
     * @var FieldValueInterface[]
     */
    protected $validValues = [];

    public function getFieldId(): string
    {
        return $this->fieldId;
    }

    public function setFieldId(string $fieldId): void
    {
        $this->fieldId = $fieldId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function setRequired(bool $required): void
    {
        $this->required = $required;
    }

    public function isVisible(): bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): void
    {
        $this->visible = $visible;
    }

    public function getDefaultValues(): array
    {
        return $this->defaultValues;
    }

    /**
     * @inheritDoc
     * @param FieldValueInterface[] $defaultValues
     */
    public function setDefaultValues(array $defaultValues): void
    {
        $this->defaultValues = $defaultValues;
    }

    public function getValidValues(): array
    {
        return $this->validValues;
    }

    /**
     * @inheritDoc
     * @param FieldValueInterface[] $validValues
     */
    public function setValidValues(array $validValues): void
    {
        $this->validValues = $validValues;
    }
}
