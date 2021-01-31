<?php

namespace JiraRestApi\Test\ServiceDesk;

use JiraRestApi\ServiceDesk\RequestType\FieldInterface;
use JiraRestApi\ServiceDesk\RequestType\RequestCreationMetaInterface;
use JiraRestApi\ServiceDesk\RequestType\RequestTypeInterface;
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

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        if (!array_key_exists('JIRA_SERVICE_DESK_ID', $_ENV)) {
            echo PHP_EOL . 'Fill the values in .env.phpunit for Service Desk tests' . PHP_EOL;
            self::markTestSkipped();
        }
    }

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

    public function testGetRequestTypes()
    {
        $query = $this->sut->getRequestTypes($this->serviceDeskId, null, null, ['field']);
        $result = $query->withLimit(2)->execute();

        self::assertNotEmpty($result->getItems());

        $rt = $result->getItems()[0];
        assert($rt instanceof RequestTypeInterface);
        self::assertNotEmpty($rt->getId());
        self::assertNotEmpty($rt->getDescription());
        self::assertNotEmpty($rt->getServiceDeskId());
        self::assertNotEmpty($rt->getIssueTypeId());
        self::assertNotEmpty($rt->getGroupIds());

        $meta = $rt->getFields();
        assert($meta instanceof RequestCreationMetaInterface);

        $field = $meta->getRequestTypeFields()[0];
        assert($field instanceof FieldInterface);
        self::assertNotEmpty($field->getFieldId());
        self::assertNotEmpty($field->getName());
    }
}
