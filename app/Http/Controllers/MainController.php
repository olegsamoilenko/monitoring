<?php

namespace App\Http\Controllers;

use App\Models\DailySummary;
use App\Models\DailySummaryCar;
use Illuminate\Http\Request;

class MainController extends Controller
{

  /**
   * Display main page.
   *
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
   */
  public function index()
  {
    $dailySummary = DailySummary::first();
    $dailySummaryCars = DailySummaryCar::all();
    return view('main.home', ['dailySummary' => $dailySummary, 'dailySummaryCars' => $dailySummaryCars]);
  }


  /**
   * Display post selection page.
   *
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
   */
  public function selectPost()
  {
    return view('main.select-post');
  }
}
