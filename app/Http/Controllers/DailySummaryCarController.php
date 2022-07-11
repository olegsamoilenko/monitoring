<?php

namespace App\Http\Controllers;

use App\Http\Requests\DailySummaryCarRequest;
use App\Models\DailySummaryCar;
use Illuminate\Http\Request;

class DailySummaryCarController extends Controller
{
  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\DailySummaryCarRequest  $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function store(DailySummaryCarRequest $request)
  {
    $data = $request->validated();

    $car = DailySummaryCar::create(
      $data
    );

    return response()->json([
      'message' => 'Автомобіль успішно доданий',
      'car' => $car
    ], 201);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\DailySummaryCar  $dailySummaryCar
   * @return \Illuminate\Http\JsonResponse
   */
  public function destroy(DailySummaryCar $dailySummaryCar)
  {
    $dailySummaryCar->delete();

    return response()->json([
      'message' => 'Автомобіль успішно видалено',
    ], 201);
  }
}
