<?php

namespace JiraRestApi;

trait ServiceDeskTrait
{
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
