<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpenseRequest;
use App\Models\Account;
use App\Models\Expense;
use App\Repositories\AccountRepository;
use App\Repositories\ExpenseRepository;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    private $expenseRepository;

    public function __construct()
    {
        $this->expenseRepository = new ExpenseRepository(new Expense());

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json($this->expenseRepository->paginate(10), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreExpenseRequest $request)
    {
        $result = $this->expenseRepository->create($request->all());
        return response()->json($result, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expenses
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expenses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expenses
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expenses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expenses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expenses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expenses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expenses)
    {
        $result = $this->expenseRepository->destroy();
    }
}
