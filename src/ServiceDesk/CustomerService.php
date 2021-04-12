<?php

namespace JiraRestApi\ServiceDesk;

use JiraRestApi\Configuration\ConfigurationInterface;
use JiraRestApi\JiraClient;
use JiraRestApi\JsonOperationsTrait;
use JiraRestApi\ServiceDesk\User\User;
use JiraRestApi\ServiceDesk\User\UserInterface;
use JiraRestApi\ServiceDeskTrait;
use Psr\Log\LoggerInterface;

/**
 * The implementation of service desk customer operations, matching the Customer group in API.
 * @see https://developer.atlassian.com/cloud/jira/service-desk/rest/api-group-customer
 */
class CustomerService extends JiraClient implements CustomerServiceInterface
{
    use ServiceDeskTrait;
    use JsonOperationsTrait;

    protected $uri = '/customer';

    public function __construct(ConfigurationInterface $configuration = null, LoggerInterface $logger = null, $path = './')
    {
        parent::__construct($configuration, $logger, $path);

        $this->setupAPIUri();
    }

    /**
     * @inheritDoc
     */
    public function createCustomer(string $email, string $displayName): UserInterface
    {
        $data = $this->encodeJson(['email' => $email, 'displayName' => $displayName]);

        $ret = $this->exec($this->uri, $data);

        return $this->deserialize($this->decodeJson($ret), User::class);
    }

    /**
     * @param object $objData
     * @param string $class
     * @return mixed|object
     */
    protected function deserialize($objData, string $class)
    {
        $mapper = $this->prepareJsonMapper();
        return $mapper->map($objData, new $class());
    }
}
