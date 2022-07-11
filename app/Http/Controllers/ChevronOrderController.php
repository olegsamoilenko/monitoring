<?php

namespace App\Http\Controllers;

use App\Models\ChevronOrder;
use App\Http\Requests\StoreChevronOrderRequest;
use App\Http\Requests\UpdateChevronOrderRequest;

class ChevronOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
      $chevronOrders = ChevronOrder::all();
//      dd($chevronOrders);
        return view('chevrons.orders', ['chevronOrders' => $chevronOrders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreChevronOrderRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreChevronOrderRequest $request)
    {
      $data = $request->validated();

      $chevronOrder = ChevronOrder::create(
        $data
      );

      return response()->json([
        'message' => 'Шеврон успішно доданий',
        'chevronOrder' => $chevronOrder
      ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChevronOrder  $chevronOrder
     * @return \Illuminate\Http\Response
     */
    public function show(ChevronOrder $chevronOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChevronOrder  $chevronOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(ChevronOrder $chevronOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateChevronOrderRequest  $request
     * @param  \App\Models\ChevronOrder  $chevronOrder
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChevronOrderRequest $request, ChevronOrder $chevronOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChevronOrder  $chevronOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChevronOrder $chevronOrder)
    {
        //
    }
}
