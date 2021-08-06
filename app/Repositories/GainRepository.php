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

    public function last_gains(int $quantity) {
        return $this->model->latest()->take($quantity)->get();
    }

    public function paginate(int $quantity)
    {
        return $this->model->where('user_id', '=', Auth::id())->simplePaginate($quantity);
    }


    public function create(array $data)
    {

        $data["user_id"] = Auth::id();
        $accountData = $this->accountRepository->increment($data['value']);
        $gainData = $this->model->create($data);

        return collect(["account" => $accountData, "gain" => $gainData]);
    }

    public function destroy($gain)
    {
        $newBalance = $this->accountRepository->decrement($gain->value);
        $gain->delete();
        return $newBalance;
    }


}
