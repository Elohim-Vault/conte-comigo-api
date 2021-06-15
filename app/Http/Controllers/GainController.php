<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGainRequest;
use App\Models\Gain;
use App\Repositories\GainRepository;
use Illuminate\Http\Request;


class GainController extends Controller
{
    private $gainRepository;

    public function __construct(GainRepository $gainRepository)
    {
        $this->gainRepository = $gainRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json($this->gainRepository->getAll(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreGainRequest $request)
    {
        $gain = $this->gainRepository->create($request->all());
        return response()->json($gain,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gain  $gain
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Gain $gain)
    {
        return response()->json($gain,200);
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
    public function destroy(Gain $gain)
    {
        $result = $this->gainRepository->destroy($gain);
        return response()->json($result, 200);
    }

    public function weeklyEarnings()
    {
        dd(date('Y-m-d'));
    }
}
