<?php

namespace JiraRestApi\ServiceDesk;

use JiraRestApi\Configuration\ConfigurationInterface;
use JiraRestApi\JiraClient;
use JiraRestApi\ServiceDesk\Comment\Comment;
use JiraRestApi\ServiceDesk\Comment\CommentInterface;
use JiraRestApi\ServiceDesk\Date\Date;
use JiraRestApi\ServiceDesk\Date\DateInterface;
use JiraRestApi\ServiceDesk\User\User;
use JiraRestApi\ServiceDesk\User\UserInterface;
use JiraRestApi\ServiceDeskTrait;
use Psr\Log\LoggerInterface;

/**
 * The interface for service desk request operations, matching the Request group in API.
 * @see https://developer.atlassian.com/cloud/jira/service-desk/rest/api-group-request
 */
class RequestService extends JiraClient implements RequestServiceInterface
{
    use ServiceDeskTrait;

    protected $uri = '/request';

    public function __construct(ConfigurationInterface $configuration = null, LoggerInterface $logger = null, $path = './')
    {
        parent::__construct($configuration, $logger, $path);

        $this->setupAPIUri();
    }

    /**
     * @inheritDoc
     */
    public function addComment($issueIdOrKey, string $body, bool $public): CommentInterface
    {
        $data = json_encode(['body' => $body, 'public' => $public]);

        $ret = $this->exec($this->issueUri($issueIdOrKey) . '/comment', $data);

        $this->json_mapper->classMap[UserInterface::class] = User::class;
        $this->json_mapper->classMap[DateInterface::class] = Date::class;

        return $this->json_mapper->map(
            json_decode($ret),
            new Comment()
        );
    }

    protected function issueUri(string $id): string {
        return $this->uri . "/$id";
    }
}
