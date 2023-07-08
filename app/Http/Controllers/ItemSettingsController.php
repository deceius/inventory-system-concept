<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Item;
use App\Models\Type;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ItemSettingsController extends Controller
{

    public function index(): View {
        return view('item-settings.index');
    }

    public function fetchTypes(Request $request): Response {
        $search = $request->input('search');
        $brands = Type::orderBy('deleted_at', 'asc')
                    ->orderBy('id', 'desc');
        if ($search) {
            $brands->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            });
        }
        return response(['result' => $brands->paginate(10)]);
    }

}
