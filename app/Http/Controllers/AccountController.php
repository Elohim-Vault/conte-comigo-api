<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountRequest;
use App\Models\Account;
use App\Models\Expense;
use App\Models\Gain;
use App\Repositories\AccountRepository;
use App\Repositories\ExpenseRepository;
use App\Repositories\GainRepository;
use Illuminate\Http\Request;

class AccountController extends Controller
{

    /**
     * @var AccountRepository
     */
    private $accountRepository;
    private $gainRepository;
    private $expenseRepository;

    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
        $this->gainRepository = new GainRepository(New Gain());
        $this->expenseRepository = new ExpenseRepository(new Expense());
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
     * Display the last five transactions of an account
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function last_transactions(int $pagination) {
        $gains = $this->gainRepository->last_gains(10);
        $expenses = $this->expenseRepository->last_expenses(10);
        $result = $gains->merge($expenses)->sortByDesc('created_at');
        $result = $result->flatten()->paginate(1);
        dd($result);
        return response()->json($result, 200);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        //
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
