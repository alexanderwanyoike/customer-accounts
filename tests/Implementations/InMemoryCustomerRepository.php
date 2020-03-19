<?php

namespace FunnyBank\Core\CustomerAccounts\Tests\Implementations;

use FunnyBank\Core\CustomerAccounts\Entities\Account;
use FunnyBank\Core\CustomerAccounts\Interfaces\CustomerAccountRepository;

class InMemoryCustomerRepository implements CustomerAccountRepository
{
    private $store = [];

    public function __construct()
    {
    }

    public function save(Account $account): void
    {
        $this->store[$account->id()] = $account;
    }

    public function delete(string $accountId): void
    {
        unset($this->store[$accountId]);
    }

    public function find(string $accountId): ?Account
    {
        return $this->store[$accountId] ?? null;
    }
}