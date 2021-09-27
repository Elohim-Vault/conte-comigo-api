<?php


namespace App\Repositories;


use App\Models\Gain;
use App\Models\Transaction;
use App\Models\User;
use App\Repositories\AccountRepository;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;

class TransactionRepository
{
    private $model;
    private $accountRepository;

    public function __construct(Transaction $model)
    {
        $this->model = $model;
        $this->accountRepository = new AccountRepository(new Account());
    }

    public function paginate(int $quantity, int $month = null) {
        $query = $this->model->where('user_id', '=', Auth::id());
        $query = $query->whereMonth('created_at', '=' , $month);

        return $query->orderBy('id', 'desc')->simplePaginate($quantity);
    }

    public function create(array $data)
    {
        $data["user_id"] = Auth::id();
        $accountData = $this->accountRepository->increment($data['value']);
        $transactionData = $this->model->create($data);

        return collect(["account" => $accountData, "transaction" => $transactionData]);
    }

    public function destroy($gain)
    {
        $newBalance = $this->accountRepository->decrement($gain->value);
        $gain->delete();
        return $newBalance;
    }

    public function sum_gain(int $month = null): int
    {
        if ($month == null)
        {
            $month = date('m');
        }
        $sum = $this->model->where('user_id', '=', Auth::id())
        ->whereMonth('created_at', '=' , $month)
        ->where('value', '>', '0')
        ->sum('value');

        return $sum;
    }

    public function sum_expenses(int $month = null): int
    {
        if ($month == null)
        {
            $month = date('m');
        }
        $sum = $this->model->where('user_id', '=', Auth::id())
        ->whereMonth('created_at', '=' , $month)
        ->where('value', '<', '0')
        ->sum('value');

        return $sum;
    }

}
