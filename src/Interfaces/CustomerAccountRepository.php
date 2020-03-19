<?php
namespace FunnyBank\Core\CustomerAccounts\Interfaces;


use FunnyBank\Core\CustomerAccounts\Entities\Account;

interface CustomerAccountRepository
{
    public function save(Account $account): void;
    public function delete(string $accountId): void;
    public function find(string $accountId): ?Account;
}