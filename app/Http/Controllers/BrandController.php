<?php

namespace App\Http\Controllers;

use App\Http\Requests\MasterData\MasterDataStoreRequest;
use App\Http\Requests\MasterData\MasterDataUpdateRequest;
use App\Models\Brand;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

class BrandController extends Controller
{
    public function create(): View {
        return view('item-settings.brand.create');
    }

    public function edit(Request $request, Brand $brand): View {
        return view('item-settings.brand.edit', ['brand' => $brand]);
    }

    public function fetchBrands(Request $request): Response {
        $search = $request->input('search');
        $inactive = filter_var($request->input('inactive'), FILTER_VALIDATE_BOOLEAN);
        $brands = Brand::orderBy('is_active', 'desc')
                    ->orderBy('id', 'desc');
        if ($search) {
            $brands->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            });
        }
        if ($inactive) {
            $brands->where('is_active', $inactive);
        }
        return response(['result' => $brands->paginate(10)]);
    }

    public function store(MasterDataStoreRequest $request): RedirectResponse
    {
        $sanitized = $request->getSanitized();
        Brand::create($sanitized);
        return Redirect::route('items.settings.index')->with('status', 'branch-created');
    }

    public function update(MasterDataUpdateRequest $request, Brand $brand): RedirectResponse
    {
        $brand->fill($request->getSanitized());
        $brand->save();
        return Redirect::route('items.settings.brands.edit', ['brand' => $brand])->with('status', 'updated');
    }

    public function activate(MasterDataUpdateRequest $request, Brand $brand): RedirectResponse
    {
        $brand->fill($request->getSanitized());
        $brand->is_active = 1;
        return $this->updateActivation($brand->fill($request->validated()), 'activated');
    }

    public function deactivate(MasterDataUpdateRequest $request, Brand $brand)//: RedirectResponse
    {
        $brand->fill($request->getSanitized());
        $brand->is_active = 0;
        return $this->updateActivation($brand, 'deactivated');
    }

    function updateActivation(Brand $brand, $status): RedirectResponse {
        $brand->save();
        $redirectRoute = $status == 'deactivated' ? Redirect::route('items.settings.index') : Redirect::route('items.settings.brands.edit', ['brand' => $brand]);
        return $redirectRoute->with('status', $status);
    }

}
