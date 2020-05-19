<?php

namespace App\Http\Controllers;

use App\TaskList;

class DashboardController extends Controller {

    public function index() {
        $lists = TaskList::all();
        return view('dashboard', ['lists' => $lists->toJson()]);
    }
}
