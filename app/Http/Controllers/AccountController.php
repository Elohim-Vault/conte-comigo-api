<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountRequest;
use App\Models\Account;
use App\Models\Transaction;
use App\Repositories\AccountRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;

class AccountController extends Controller
{

    /**
     * @var AccountRepository
     */
    private $accountRepository;
    private $transactionRepository;

    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
        $this->transactionRepository = new TransactionRepository(new Transaction());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json($this->accountRepository->show(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAccountRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $account = $this->accountRepository->create($request->all());
        return response()->json($account, 201);
    }

    /**
     * Return the financial data of an account..
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\JsonResponse
     */
    public function financial_data(Request $request)
    {
        $sum_gain = $this->transactionRepository->sum_gain($request->month);
        $sum_expense = $this->transactionRepository->sum_expenses($request->month);
        $savings = $sum_gain + $sum_expense;
        $response = [
            "gains" => $sum_gain,
            "expenses" => $sum_expense,
            "savings" => $savings
        ];
        return response()->json($response, 200);
    }

    public function update(Request $request, Account $account) 
    {
        $account->update($request->all());
        return $account;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        //
    }
}
