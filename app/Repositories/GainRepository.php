<?php


namespace App\Repositories;


use App\Models\Gain;
use App\Models\User;
use App\Repositories\AccountRepository;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;

class GainRepository
{
    private $model;
    private $accountRepository;

    public function __construct(Gain $model)
    {
        $this->model = $model;
        $this->accountRepository = new AccountRepository(new Account());
    }

    public function getAll() {
        return Auth::user()->gains;
    }

    public function create(array $data)
    {

        $data["user_id"] = Auth::id();
        $accountData = $this->accountRepository->newGain($data);
        $gainData = $this->model->create($data);

        return response()->json([
            "account" => $accountData,
            "gain" => $gainData
        ],201);
    }

    public function destroy($gain, $account)
    {
        $newBalance = $this->accountRepository->destroyGain($gain, $account);
        $gain->delete();
        return $newBalance;
    }
}
