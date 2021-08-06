<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Models\Transaction;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $response = $this->transactionRepository->paginate($request->quantity);
        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreTransactionRequest $request)
    {
        $gain = $this->transactionRepository->create($request->all());
        return response()->json($gain, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gain  $gain
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Transaction $gain)
    {
        return response()->json($this->transactionRepository->sum_gain(), 200);
//        return response()->json($gain, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gain  $gain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gain $gain)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gain  $gain
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Transaction $gain)
    {
        $result = $this->transactionRepository->destroy($gain);
        return response()->json($result, 200);
    }

    public function weeklyEarnings()
    {
        dd(date('Y-m-d'));
    }
}

