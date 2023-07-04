<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ItemsController extends Controller
{
    public function index(): View {
        return view('items.index', ['count' => 0]);
    }

    public function fetchItems(Request $request): Response {
        $search = $request->input('search');
        $inactive = filter_var($request->input('inactive'), FILTER_VALIDATE_BOOLEAN);
        $items = Item::orderBy('is_active', 'desc')
                    ->orderBy('id', 'asc');
        if ($search) {
            $items->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            });
        }
        if ($inactive) {
            $items->where('is_active', $inactive);
        }

        $items->with('brand');
        $items->with('type');
        $items->simplePaginate(15);
        return response(['result' => $items->paginate(10)]);
    }
}
