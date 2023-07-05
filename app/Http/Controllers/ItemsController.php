<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ItemsController extends Controller
{
    public function index(): View {
        return view('items.index');
    }

    public function fetchItems(Request $request): Response {
        $search = $request->input('search');
        $inactive = filter_var($request->input('inactive'), FILTER_VALIDATE_BOOLEAN);
        $items = Item::orderBy('is_active', 'desc')
                    ->orderBy('id', 'asc');
        $items->with('brand');
        $items->with('type');
        if ($search) {
            $items->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
                $query->orWhereHas('brand', function($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%');
                });
            });
        }
        if ($inactive) {
            $items->where('is_active', $inactive);
        }
        return response(['result' => $items->paginate(10)]);
    }
}
