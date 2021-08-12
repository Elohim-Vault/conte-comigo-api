<?php

namespace App\Repositories;
use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AccountRepository
{
    private $model;
    private $transactionRepository;

    public function __construct(Account $model)
    {
        $this->model = $model;
    }

    public function show()
    {
        return User::find(Auth::id())->account;
    }


    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function increment($value)
    {
        $account = User::find(Auth::id())->account;
        $account->increment('value', $value);
        return $account;
    }

    public function decrement($value)
    {
        $account = User::find(Auth::id())->account;
        $account->decrement('value', $value);
        return $account;
    }

}
