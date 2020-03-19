<?php
namespace FunnyBank\Core\CustomerAccounts\Boundries\TransferFunds;

class TransferFundsResponse
{
    private $amount;
    private $sender;
    private $receiver;

    public function __construct(string $sender, string $receiver, string $amount)
    {
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->amount = $amount;
    }

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function getSender(): string
    {
        return $this->sender;
    }

    public function getReceiver(): string
    {
        return $this->receiver;
    }
}
