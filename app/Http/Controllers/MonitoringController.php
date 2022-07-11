<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{

  /**
   * Show the form for search
   *
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    return view('monitoring.monitoring');
  }

  /**
   * View result
   *
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
   */

  public function monitoring()
  {

    return view('monitoring.result');
  }

  /**
   * Paginate products
   *
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
   */

  public function paginationMonitoring(Request $request)
  {

    if (!$request->carMonitoringOrderBy) {
      $cars = Car::
      when($request->carMonitoringNumber, function ($query, $carMonitoringNumber) {
        return $query->where('number', $carMonitoringNumber);
      })
        ->when($request->carMonitoringStartDate, function ($query, $carMonitoringStartDate) {
          return $query->where('created_at', '>', $carMonitoringStartDate);
        })
        ->when($request->carMonitoringEndDate, function ($query, $carMonitoringEndDate) {
          return $query->where('created_at', '<', $carMonitoringEndDate);
        })
        ->when($request->carMonitoringPost, function ($query, $carMonitoringPost) {
          return $query->where('post', $carMonitoringPost);
        })
        ->orderBy('created_at', $request->carMonitoringSortDate)->with('user')->paginate($request->carMonitoringPerPage);
    } else {
      $cars = Car::
      when($request->carMonitoringNumber, function ($query, $carMonitoringNumber) {
        return $query->where('number', $carMonitoringNumber);
      })
        ->when($request->carMonitoringStartDate, function ($query, $carMonitoringStartDate) {
          return $query->where('created_at', '>', $carMonitoringStartDate);
        })
        ->when($request->carMonitoringEndDate, function ($query, $carMonitoringEndDate) {
          return $query->where('created_at', '<', $carMonitoringEndDate);
        })
        ->when($request->carMonitoringPost, function ($query, $carMonitoringPost) {
          return $query->where('post', $carMonitoringPost);
        })
        ->orderBy($request->carMonitoringOrderBy, $request->carMonitoringDirection)->orderBy('created_at', $request->carMonitoringSortDate)->with('user')->paginate($request->carMonitoringPerPage);
    }

    $cars->withPath('search/');


    return response()->json([
      'cars' => $cars,
    ], 201);
  }
}
