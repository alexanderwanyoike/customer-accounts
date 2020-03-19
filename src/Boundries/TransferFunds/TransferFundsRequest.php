<?php


namespace FunnyBank\Core\CustomerAccounts\Boundries\TransferFunds;


class TransferFundsRequest
{
    private $amount;
    private $sender;
    private $receiver;

    public function __construct(string $sender, string $receiver, float $amount)
    {
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->amount = $amount;
    }

    public function getReceiver()
    {
        return $this->receiver;
    }

    public function getSender()
    {
        return $this->sender;
    }

    public function getAmount()
    {
        return $this->amount;
    }
}