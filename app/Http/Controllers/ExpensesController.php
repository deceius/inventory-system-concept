<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    public function index(): View {
        return view('expenses.index');
    }
}
