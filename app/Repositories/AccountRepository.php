<?php


namespace App\Repositories;
use App\Models\Account;
use App\Models\Gain;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AccountRepository
{
    private $model;

    public function __construct(Account $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        $this->model->create($data);
    }

    public function newGain(array $data)
    {
        $gain = $data['value'];
//        if(!isset($data['account']))
//        {
//            $data['account'] = 'Sua conta';
//        }

        $account = User::find(Auth::id())->accounts->firstWhere('nickname',$data['account']);


        $account->increment('value', $gain);
        return $account;
    }

    public function destroyGain(Gain $gain, $account)
    {
        $userAccount = User::find(Auth::id())->accounts->firstWhere('nickname', $account);
        $userAccount->decrement('value', $gain->value);
        return $userAccount;
    }
}
