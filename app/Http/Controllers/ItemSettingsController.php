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
        return view('item-settings.index', ['count' => 0]);
    }

    public function fetchBrands(Request $request): Response {
        $search = $request->input('search');
        $inactive = filter_var($request->input('inactive'), FILTER_VALIDATE_BOOLEAN);
        $brands = Brand::orderBy('is_active', 'desc')
                    ->orderBy('id', 'asc');
        if ($search) {
            $brands->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            });
        }
        if ($inactive) {
            $brands->where('is_active', $inactive);
        }
        $brands->simplePaginate(15);
        return response(['result' => $brands->paginate(10)]);
    }

    public function fetchTypes(Request $request): Response {
        $search = $request->input('search');
        $inactive = filter_var($request->input('inactive'), FILTER_VALIDATE_BOOLEAN);
        $brands = Type::orderBy('is_active', 'desc')
                    ->orderBy('id', 'asc');
        if ($search) {
            $brands->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            });
        }
        if ($inactive) {
            $brands->where('is_active', $inactive);
        }
        $brands->simplePaginate(15);
        return response(['result' => $brands->paginate(10)]);
    }

}
