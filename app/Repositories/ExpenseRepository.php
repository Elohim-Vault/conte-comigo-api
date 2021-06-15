<?php


namespace App\Repositories;


use App\Models\Expense;
use App\Models\User;
use App\Repositories\AccountRepository;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;

class ExpenseRepository
{
    private $model;
    private $accountRepository;

    public function __construct(Expense $model)
    {
        $this->model = $model;
        $this->accountRepository = new AccountRepository(new Account());
    }

    public function getAll() {
        return Auth::user()->expenses;
    }


    public function paginate(int $quantity) {
        return $this->model->where('user_id', '=', Auth::id())->simplePaginate($quantity);
    }

    public function create(array $data)
    {
        $data["user_id"] = Auth::id();
        $accountData = $this->accountRepository->decrement($data['value']);
        $expenseData = $this->model->create($data);

        return collect(["account" => $accountData, "expense" => $expenseData]);

    }

    public function destroy(array $data)
    {
        $newBalance = $this->accountRepository->increment($gain, $account);
        $gain->delete();
        return $newBalance;
    }
}
