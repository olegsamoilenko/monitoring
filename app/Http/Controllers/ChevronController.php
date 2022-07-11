<?php

namespace App\Http\Controllers;

use App\Models\Chevron;
use App\Models\ChevronOrder;
use Illuminate\Http\Request;
use App\Http\Requests\StoreChevronRequest;
use App\Http\Requests\UpdateChevronRequest;
use stdClass;

class ChevronController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
   */
  public function index()
  {
    $chevrons = Chevron::all();

    return view('chevrons.index', ['chevrons' => $chevrons]);
  }

  /**
   * getSortedChevronsByAmount
   *
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
   */

  public function getSortedChevronsByAmount(Request $request)
  {
    $total = count(Chevron::all());
    $chevrons = [];
    for ($i = 1; $i <= $total; $i++) {
      $chevronOrders = ChevronOrder::where('chevron_id', $i)->get();
      $total_amount = 0;
      foreach ($chevronOrders as $value) {
        $total_amount += $value->amount;
      }
      $object = new stdClass();
      $object->chevron_id = $i;
      $object->total_amount = $total_amount;
      if ($object->total_amount > 0) {
        array_push($chevrons, $object);
      }

    }


    return response()->json([
      'chevrons' => $chevrons,
    ], 201);
  }

  /**
   * getSortedChevronsByAmount
   *
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
   */

  public function getSortedChevronsBySurname(Request $request)
  {
    $orders = ChevronOrder::orderBy('surname')->get();

    return response()->json([
      'orders' => $orders,
    ], 201);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \App\Http\Requests\StoreChevronRequest $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreChevronRequest $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param \App\Models\Chevron $chevron
   * @return \Illuminate\Http\Response
   */
  public function show(Chevron $chevron)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param \App\Models\Chevron $chevron
   * @return \Illuminate\Http\Response
   */
  public function edit(Chevron $chevron)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \App\Http\Requests\UpdateChevronRequest $request
   * @param \App\Models\Chevron $chevron
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateChevronRequest $request, Chevron $chevron)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \App\Models\Chevron $chevron
   * @return \Illuminate\Http\Response
   */
  public function destroy(Chevron $chevron)
  {
    //
  }
}
