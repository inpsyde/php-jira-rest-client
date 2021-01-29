<?php

namespace JiraRestApi\ServiceDesk;

use JiraRestApi\Configuration\ConfigurationInterface;
use JiraRestApi\JiraClient;
use JiraRestApi\Pagination\PaginatedQuery;
use JiraRestApi\Pagination\PaginatedQueryInterface;
use JiraRestApi\ServiceDesk\Link\SelfLink;
use JiraRestApi\ServiceDesk\Link\SelfLinkInterface;
use JiraRestApi\ServiceDesk\RequestType\Field;
use JiraRestApi\ServiceDesk\RequestType\FieldInterface;
use JiraRestApi\ServiceDesk\RequestType\FieldValue;
use JiraRestApi\ServiceDesk\RequestType\FieldValueInterface;
use JiraRestApi\ServiceDesk\RequestType\RequestCreationMeta;
use JiraRestApi\ServiceDesk\RequestType\RequestCreationMetaInterface;
use JiraRestApi\ServiceDesk\RequestType\RequestType;
use JiraRestApi\ServiceDesk\RequestType\RequestTypeInterface;
use JiraRestApi\ServiceDesk\ServiceDesk\ServiceDesk;
use JiraRestApi\ServiceDesk\ServiceDesk\ServiceDeskInterface;
use JiraRestApi\ServiceDesk\User\User;
use JiraRestApi\ServiceDesk\User\UserInterface;
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
    public function getServiceDesks(): PaginatedQueryInterface
    {
        return new PaginatedQuery(function (array $paginationQuery) {
            $response = $this->exec($this->uri . '?' . http_build_query($paginationQuery));
            return json_decode($response, false);
        }, function ($itemData): ServiceDeskInterface {
            $this->json_mapper->classMap[SelfLinkInterface::class] = SelfLink::class;

            return $this->json_mapper->map($itemData, new ServiceDesk());
        });
    }

    /**
     * @inheritDoc
     */
    public function getCustomers(string $serviceDeskId, string $query = null): PaginatedQueryInterface
    {
        $this->allowExperimentalApi();

        $url = $this->serviceDeskUri($serviceDeskId) . '/customer';
        $params = ['query' => $query];

        return new PaginatedQuery(function (array $paginationQuery) use ($url, $params) {
            $response = $this->exec($url . '?' . http_build_query(array_merge($params, $paginationQuery)));
            return json_decode($response, false);
        }, function ($itemData): UserInterface {
            $this->json_mapper->classMap[UserLinkInterface::class] = UserLink::class;

            return $this->json_mapper->map($itemData, new User());
        });
    }

    /**
     * @inheritDoc
     */
    public function getRequestTypes(
        string $serviceDeskId,
        int $groupId = null,
        string $searchQuery = null,
        array $expand = null
    ): PaginatedQueryInterface
    {
        $url = $this->serviceDeskUri($serviceDeskId) . '/requesttype';
        $params = [
            'groupId' => $groupId,
            'searchQuery' => $searchQuery,
            'expand' => $expand ? implode(',', $expand) : null,
        ];

        return new PaginatedQuery(function (array $paginationQuery) use ($url, $params) {
            $response = $this->exec($url . '?' . http_build_query(array_merge($params, $paginationQuery)));
            return json_decode($response, false);
        }, function ($itemData): RequestTypeInterface {
            $this->json_mapper->classMap[RequestCreationMetaInterface::class] = RequestCreationMeta::class;
            $this->json_mapper->classMap[FieldInterface::class] = Field::class;
            $this->json_mapper->classMap[FieldValueInterface::class] = FieldValue::class;
            $this->json_mapper->classMap[SelfLinkInterface::class] = SelfLink::class;

            return $this->json_mapper->map($itemData, new RequestType());
        });
    }

    protected function serviceDeskUri(string $serviceDeskId): string {
        return $this->uri . "/$serviceDeskId";
    }
}
