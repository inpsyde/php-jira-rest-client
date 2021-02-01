<?php

namespace JiraRestApi\ServiceDesk\Request;

/**
 * The valid values for request status categories.
 */
interface StatusCategory
{
    public const UNDEFINED = 'UNDEFINED';
    public const NEW = 'NEW';
    public const INDETERMINATE = 'INDETERMINATE';
    public const DONE = 'DONE';
}