<?php

namespace JiraRestApi\ServiceDesk\Request;

/**
 * Request field value. CustomerRequestFieldValueDTO from the JIRA Service Desk API.
 */
interface FieldValueInterface
{
    /**
     * @return string
     */
    public function getFieldId(): string;

    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @return string
     */
    public function getLabel(): string;

    /**
     * Returns value of the field rendered in the UI.
     * @return object
     */
    public function getRenderedValue();
}
