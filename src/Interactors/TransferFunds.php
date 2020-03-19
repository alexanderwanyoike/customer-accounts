<?php
namespace FunnyBank\Core\CustomerAccounts\Interactors;

use FunnyBank\Core\CustomerAccounts\Boundries\TransferFunds\TransferFundsRequest;
use FunnyBank\Core\CustomerAccounts\Boundries\TransferFunds\TransferFundsResponse;
use FunnyBank\Core\CustomerAccounts\Interfaces\CustomerAccountRepository;

class TransferFunds
{
    private $customerAccountRepository;

    public function __construct(CustomerAccountRepository $customerAccountRepository)
    {
        $this->customerAccountRepository = $customerAccountRepository;
    }

    public function __invoke(TransferFundsRequest $request): TransferFundsResponse
    {
        $sender = $this->customerAccountRepository->find($request->getSender());
        if (!$sender) {
            throw new \LogicException('Sender does not exist');
        }

        $receiver = $this->customerAccountRepository->find($request->getReceiver());
        if (!$receiver) {
            throw new \LogicException('Receiver');
        }

        if ($sender->amount() < $request->getAmount()) {
            throw new \LogicException('Insufficient funds');
        }

        $sender->withdraw($request->getAmount());
        $receiver->deposit($request->getAmount());

        $this->customerAccountRepository->save($sender);
        $this->customerAccountRepository->save($receiver);

        return new TransferFundsResponse($sender->id(), $receiver->id(), $request->getAmount());
    }
}