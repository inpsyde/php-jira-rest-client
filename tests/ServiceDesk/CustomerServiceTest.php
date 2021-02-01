<?php

namespace JiraRestApi\Test\ServiceDesk;

use JiraRestApi\ServiceDesk\CustomerService;
use JiraRestApi\ServiceDesk\CustomerServiceInterface;
use JiraRestApi\User\UserService;
use PHPUnit\Framework\TestCase;

class CustomerServiceTest extends TestCase
{
    /**
     * @var CustomerServiceInterface
     */
    protected $sut;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sut = new CustomerService();
    }

    public function testCreateCustomer()
    {
        $email = 'test' . rand() .'@gmail.com';

        $customer = $this->sut->createCustomer($email, 'Test User');

        self::assertNotEmpty($customer->getAccountId());
        self::assertEquals($email, $customer->getEmailAddress());
        self::assertEquals('Test User', $customer->getDisplayName());

        // cleanup
        $userService = new UserService();
        $userService->deleteUser(['accountId' => $customer->getAccountId()]);
    }
}
