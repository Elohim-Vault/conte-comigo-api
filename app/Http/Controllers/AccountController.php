<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountRequest;
use App\Models\Account;
use App\Repositories\AccountRepository;
use Illuminate\Http\Request;

class AccountController extends Controller
{

    /**
     * @var AccountRepository
     */
    private $accountRepository;


    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json($this->accountRepository->getAll(), 200);
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
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        //
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
