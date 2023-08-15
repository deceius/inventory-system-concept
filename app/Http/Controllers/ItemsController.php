<?php

namespace App\Http\Controllers;

use App\Http\Requests\Item\ItemStoreRequest;
use App\Http\Requests\Item\ItemUpdateRequest;
use App\Models\Brand;
use App\Models\Item;
use App\Models\Type;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

class ItemsController extends Controller
{
    public function index(): View {
        return view('items.index');
    }

    public function create(): View {
        $brands = Brand::all();
        $types = Type::all();
        return view('items.create', ['brands' => $brands, 'types' => $types]);
    }

    public function edit(Request $request, Item $item): View {
        $brands = Brand::all();
        $types = Type::all();
        return view('items.edit', ['item' => $item, 'brands' => $brands, 'types' => $types]);
    }

    public function store(ItemStoreRequest $request): RedirectResponse
    {
        $sanitized = $request->getSanitized();
        Item::create($sanitized);
        return Redirect::route('items.index')->with('status', 'item-created');
    }

    public function update(ItemUpdateRequest $request, Item $item): RedirectResponse
    {
        $item->fill($request->getSanitized());
        $item->save();
        return Redirect::route('items.edit', ['item' => $item])->with('status', 'updated');
    }

    public function activate(ItemUpdateRequest $request, $id): RedirectResponse
    {
        $item = Item::withTrashed()->find($id);
        $item->restore();
        return $this->updateActivation($item->fill($request->validated()), 'activated');
    }

    public function deactivate(ItemUpdateRequest $request, Item $item): RedirectResponse
    {
        $item->fill($request->getSanitized());
        $item->delete();
        return $this->updateActivation($item, 'deactivated');
    }

    function updateActivation(Item $item, $status): RedirectResponse {

        $brands = Brand::all();
        $types = Type::all();

        $item->save();
        $redirectRoute = $status == 'deactivated' ? Redirect::route('items.index') : Redirect::route('items.edit', ['item' => $item, 'brands' => $brands, 'types' => $types]);
        return $redirectRoute->with('status', $status);
    }


    public function fetchItems(Request $request): Response {
        $search = $request->input('search');
        $inactive = filter_var($request->input('inactive'), FILTER_VALIDATE_BOOLEAN);
        $items = Item::orderBy('deleted_at', 'asc')
                    ->orderBy('id', 'desc');
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
        $items->withTrashed();
        return response(['result' => $items->paginate(10)]);
    }
}
