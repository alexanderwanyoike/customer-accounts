<?php
namespace FunnyBank\Core\CustomerAccounts\Tests\Interactors;

use FunnyBank\Core\CustomerAccounts\Boundries\TransferFunds\TransferFundsRequest;
use FunnyBank\Core\CustomerAccounts\Entities\Account;
use FunnyBank\Core\CustomerAccounts\Interactors\TransferFunds;
use FunnyBank\Core\CustomerAccounts\Tests\Implementations\InMemoryCustomerRepository;
use PHPUnit\Framework\TestCase;

class TransferFundsTest extends TestCase
{
    public function testTransferWithNonExistentSender()
    {
        self::expectException(\LogicException::class);
        $inMemoryRepository = new InMemoryCustomerRepository();
        $transferFunds = new TransferFunds($inMemoryRepository);
        $transferFunds(new TransferFundsRequest('A', 'B', 100.3));
    }

    public function testTransferWithNonExistentReceiver()
    {
        self::expectException(\LogicException::class);
        $inMemoryRepository = new InMemoryCustomerRepository();
        $inMemoryRepository->save(new Account('A', 'Mike'));
        $transferFunds = new TransferFunds($inMemoryRepository);
        $transferFunds(new TransferFundsRequest('A', 'B', 100.3));
    }

    public function testTransferWithInSufficientFundsFromSender()
    {
        self::expectException(\LogicException::class);
        $inMemoryRepository = new InMemoryCustomerRepository();
        $inMemoryRepository->save(new Account('A', 'Mike'));
        $inMemoryRepository->save(new Account('B', 'Mike'));
        $transferFunds = new TransferFunds($inMemoryRepository);
        $transferFunds(new TransferFundsRequest('A', 'B', 100.3));
    }

    public function testTransferWithSufficientFundsFromSender()
    {
        $inMemoryRepository = new InMemoryCustomerRepository();
        $account = new Account('A', 'Mike');
        $account->deposit(3000);
        $inMemoryRepository->save($account);
        $inMemoryRepository->save(new Account('B', 'Mike'));
        $transferFunds = new TransferFunds($inMemoryRepository);
        $response = $transferFunds(new TransferFundsRequest('A', 'B', 100.3));
        self::assertEquals($response->getAmount(), 100.3);
        self::assertEquals($response->getSender(), 'A');
        self::assertEquals($response->getReceiver(), 'B');
        $account = $inMemoryRepository->find('A');
        self::assertEquals(2899.7, $account->amount());
        $account = $inMemoryRepository->find('B');
        self::assertEquals(100.3, $account->amount());
    }
}