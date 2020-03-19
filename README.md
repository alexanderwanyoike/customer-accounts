# Customer Accounts

Simple project used to explain the key ideas of clean architecture

## Getting Started

### Usage
In order to use the customer accounts component we can create an instance of the interactor and then instantiate a request
with the required data and the call will return a response.

```php
<?php
use FunnyBank\Core\CustomerAccounts\Interfaces\CustomerAccountRepository;
use FunnyBank\Core\CustomerAccounts\Interactors\TransferFunds;
use FunnyBank\Core\CustomerAccounts\Entities\Account;
use FunnyBank\Core\CustomerAccounts\Boundries\TransferFunds\TransferFundsRequest;
use FunnyBank\Core\CustomerAccounts\Boundries\TransferFunds\TransferFundsResponse;

class SQLCustomerAccountRepository implements CustomerAccountRepository 
{
    public function __construct()
    {
    }

    public function save(Account $account): void
    {
        //Implementation here
    }

    public function delete(string $accountId): void
    {
        //Implementation here
    }

    public function find(string $accountId): ?Account
    {
        //Implementation here
    }
}


$customerRepository = new SQLCustomerAccountRepository();
$transferFunds = new TransferFunds($customerRepository);

$request = new TransferFundsRequest('A', 'B', 1000.32);
/** @var TransferFundsResponse $response */
$response = $transferFunds($request);

```


## Running the tests

Execute the following to run the tests.

```
$ vendor/bin/phpunit
```


## Built With

* [PHPUnit](https://phpunit.de/) - Testing framework

## Authors

* **Alexander Wanyoike** - *Initial work*
