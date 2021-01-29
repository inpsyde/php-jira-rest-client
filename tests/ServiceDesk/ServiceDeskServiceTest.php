<?php

namespace JiraRestApi\Test\ServiceDesk;

use JiraRestApi\ServiceDesk\ServiceDeskService;
use JiraRestApi\ServiceDesk\ServiceDeskServiceInterface;
use JiraRestApi\ServiceDesk\User\User;
use PHPUnit\Framework\TestCase;

class ServiceDeskServiceTest extends TestCase
{
    /**
     * @var ServiceDeskServiceInterface
     */
    protected $sut;

    protected $serviceDeskId = 3;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sut = new ServiceDeskService();
    }


    public function testGetCustomers(): User
    {
        $query = $this->sut->getCustomers($this->serviceDeskId);
        $result = $query->withLimit(2)->execute();

        self::assertCount(2, $result->getItems());

        $user = $result->getItems()[0];
        assert($user instanceof User);
        self::assertNotEmpty($user->getAccountId());
        self::assertNotEmpty($user->getEmailAddress());
        self::assertNotEmpty($user->getLinks()->getJiraRest());

        return $user;
    }

    /**
     * @depends testGetCustomers
     */
    public function testFindCustomers(User $userToFind)
    {
        $query = $this->sut->getCustomers($this->serviceDeskId, $userToFind->getEmailAddress());
        $result = $query->execute();

        self::assertCount(1, $result->getItems());

        $user = $result->getItems()[0];
        assert($user instanceof User);
        self::assertEquals($userToFind->getAccountId(), $user->getAccountId());
        self::assertEquals($userToFind->getEmailAddress(), $user->getEmailAddress());
    }
}
