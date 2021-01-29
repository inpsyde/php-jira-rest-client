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
     * @param string $fieldId
     */
    public function setFieldId(string $fieldId): void;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     */
    public function setName(string $name): void;

    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @param string $description
     */
    public function setDescription(string $description): void;

    /**
     * @return bool
     */
    public function isRequired(): bool;

    /**
     * @param bool $required
     */
    public function setRequired(bool $required): void;

    /**
     * @return bool
     */
    public function isVisible(): bool;

    /**
     * @param bool $visible
     */
    public function setVisible(bool $visible): void;

    /**
     * @return FieldValueInterface[]
     */
    public function getDefaultValues(): array;

    /**
     * @param FieldValueInterface[] $defaultValues
     */
    public function setDefaultValues(array $defaultValues): void;

    /**
     * @return FieldValueInterface[]
     */
    public function getValidValues(): array;

    /**
     * @param FieldValueInterface[] $validValues
     */
    public function setValidValues(array $validValues): void;
}