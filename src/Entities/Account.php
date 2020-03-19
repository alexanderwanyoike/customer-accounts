<?php

namespace FunnyBank\Core\CustomerAccounts\Entities;

class Account
{

    private $id;
    private $amount = 0.0;
    private $name;

    public function deposit(float $amount)
    {
        $this->amount += $amount;
    }

    public function withdraw(float $amount)
    {
        $this->amount -= $amount;
    }

    public function amount()
    {
        return $this->amount;
    }

    public function name()
    {
        return $this->name;
    }

    public function id()
    {
        return $this->id;
    }

    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}