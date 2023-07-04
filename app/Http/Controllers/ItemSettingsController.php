<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ItemSettingsController extends Controller
{

    public function index(): View {
        return view('item-settings.index', ['count' => 0]);
    }
}
