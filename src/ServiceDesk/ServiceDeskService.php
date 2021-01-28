<?php

namespace JiraRestApi\ServiceDesk;

use JiraRestApi\Configuration\ConfigurationInterface;
use JiraRestApi\JiraClient;
use JiraRestApi\Pagination\PaginatedQuery;
use JiraRestApi\Pagination\PaginatedQueryInterface;
use JiraRestApi\ServiceDesk\User\User;
use JiraRestApi\ServiceDesk\User\UserLink;
use JiraRestApi\ServiceDesk\User\UserLinkInterface;
use JiraRestApi\ServiceDeskTrait;
use Psr\Log\LoggerInterface;

/**
 * The implementation of service desk operations, matching the Servicedesk group in API.
 * @see https://developer.atlassian.com/cloud/jira/service-desk/rest/api-group-servicedesk
 */
class ServiceDeskService extends JiraClient implements ServiceDeskServiceInterface
{
    use ServiceDeskTrait;

    protected $uri = '/servicedesk';

    public function __construct(ConfigurationInterface $configuration = null, LoggerInterface $logger = null, $path = './')
    {
        parent::__construct($configuration, $logger, $path);

        $this->setupAPIUri();
    }

    /**
     * @inheritDoc
     */
    public function getCustomers(int $serviceDeskId, string $query = null): PaginatedQueryInterface
    {
        $this->allowExperimentalApi();

        $url = $this->serviceDeskUri($serviceDeskId) . '/customer';
        $params = ['query' => $query];

        return new PaginatedQuery(function (array $paginationQuery) use ($url, $params) {
            $response = $this->exec($url . '?' . http_build_query(array_merge($params, $paginationQuery)));
            return json_decode($response, false);
        }, function ($itemData): User {
            $this->json_mapper->classMap[UserLinkInterface::class] = UserLink::class;

            return $this->json_mapper->map($itemData, new User());
        });
    }

    protected function serviceDeskUri(int $serviceDeskId): string {
        return $this->uri . "/$serviceDeskId";
    }
}
