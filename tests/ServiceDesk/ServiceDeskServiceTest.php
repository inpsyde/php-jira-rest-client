<?php

namespace JiraRestApi\Test\ServiceDesk;

use JiraRestApi\ServiceDesk\ServiceDesk\ServiceDeskInterface;
use JiraRestApi\ServiceDesk\ServiceDeskService;
use JiraRestApi\ServiceDesk\ServiceDeskServiceInterface;
use JiraRestApi\ServiceDesk\User\UserInterface;
use PHPUnit\Framework\TestCase;

class ServiceDeskServiceTest extends TestCase
{
    /**
     * @var ServiceDeskServiceInterface
     */
    protected $sut;

    protected $serviceDeskId;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sut = new ServiceDeskService();

        $this->serviceDeskId = (string) $_ENV['JIRA_SERVICE_DESK_ID'];
    }

    public function testGetServiceDesks()
    {
        $query = $this->sut->getServiceDesks();
        $result = $query->withLimit(10)->execute();

        self::assertNotEmpty($result->getItems());

        $sd = $result->getItems()[0];
        assert($sd instanceof ServiceDeskInterface);
        self::assertNotEmpty($sd->getId());
        self::assertNotEmpty($sd->getProjectId());
        self::assertNotEmpty($sd->getProjectKey());
        self::assertNotEmpty($sd->getProjectName());
        self::assertNotEmpty($sd->getLinks()->getSelf());
    }

    public function testGetCustomers(): UserInterface
    {
        $query = $this->sut->getCustomers($this->serviceDeskId);
        $result = $query->withLimit(2)->execute();

        self::assertCount(2, $result->getItems());

        $user = $result->getItems()[0];
        assert($user instanceof UserInterface);
        self::assertNotEmpty($user->getAccountId());
        self::assertNotEmpty($user->getEmailAddress());
        self::assertNotEmpty($user->getLinks()->getJiraRest());

        return $user;
    }

    /**
     * @depends testGetCustomers
     */
    public function testFindCustomers(UserInterface $userToFind)
    {
        $query = $this->sut->getCustomers($this->serviceDeskId, $userToFind->getEmailAddress());
        $result = $query->execute();

        self::assertCount(1, $result->getItems());

        $user = $result->getItems()[0];
        assert($user instanceof UserInterface);
        self::assertEquals($userToFind->getAccountId(), $user->getAccountId());
        self::assertEquals($userToFind->getEmailAddress(), $user->getEmailAddress());
    }
}
