<?php

namespace JiraRestApi;

trait ServiceDeskTrait
{
    abstract protected function addHeader(string $key, string $value);

    protected function setupAPIUri($version = '')
    {
        $uri = '/rest/servicedeskapi';
        $uri .= ($version != '') ? '/'.$version : '';
        $this->setAPIUri($uri);
    }

    protected function allowExperimentalApi()
    {
        $this->addHeader('X-ExperimentalApi', 'opt-in');
    }
}
