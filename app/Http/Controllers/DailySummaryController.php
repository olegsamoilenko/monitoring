<?php

namespace App\Http\Controllers;

use App\Http\Requests\DailySummaryRequest;
use App\Models\DailySummary;
use Illuminate\Http\Request;

class DailySummaryController extends Controller
{
  /**
   * Show the form for editing the specified resource.
   *
   * @param
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
   */
  public function edit()
  {
    $dailySummary = DailySummary::first();

    return view('summary.daily-summary-edit', ['dailySummary' => $dailySummary]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \App\Http\Requests\DailySummaryRequest $request
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function update(DailySummaryRequest $request)
  {
    $dailySummary = DailySummary::find($request->id);
    $data = $request->validated();

    $dailySummary->text = $data['text'];
    $dailySummary->save();

    return response()->json([
      'message' => 'Оперативна ситуація успішно оновлена',
      'dailySummary' => $dailySummary,
    ], 201);
  }
}
