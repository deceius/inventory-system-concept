<?php

namespace App\Http\Controllers;

use App\Http\Requests\MasterData\MasterDataStoreRequest;
use App\Http\Requests\MasterData\MasterDataUpdateRequest;
use App\Models\Type;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

class TypesController extends Controller
{
    public function create(): View {
        return view('item-settings.type.create');
    }

    public function edit(Request $request, Type $type): View {
        return view('item-settings.type.edit', ['type' => $type]);
    }

    public function fetchTypes(Request $request): Response {
        $search = $request->input('search');
        $inactive = filter_var($request->input('inactive'), FILTER_VALIDATE_BOOLEAN);
        $types = Type::orderBy('is_active', 'desc')
                    ->orderBy('id', 'desc');
        if ($search) {
            $types->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            });
        }
        if ($inactive) {
            $types->where('is_active', $inactive);
        }
        return response(['result' => $types->paginate(10)]);
    }

    public function store(MasterDataStoreRequest $request): RedirectResponse
    {
        $sanitized = $request->getSanitized();
        Type::create($sanitized);
        return Redirect::route('items.settings.index')->with('status', 'type-created');
    }

    public function update(MasterDataUpdateRequest $request, Type $type): RedirectResponse
    {
        $type->fill($request->getSanitized());
        $type->save();
        return Redirect::route('items.settings.types.edit', ['type' => $type])->with('status', 'updated');
    }

    public function activate(MasterDataUpdateRequest $request, Type $type): RedirectResponse
    {
        $type->fill($request->getSanitized());
        $type->is_active = 1;
        return $this->updateActivation($type->fill($request->validated()), 'activated');
    }

    public function deactivate(MasterDataUpdateRequest $request, Type $type)//: RedirectResponse
    {
        $type->fill($request->getSanitized());
        $type->is_active = 0;
        return $this->updateActivation($type, 'deactivated');
    }

    function updateActivation(Type $type, $status): RedirectResponse {
        $type->save();
        $redirectRoute = $status == 'deactivated' ? Redirect::route('items.settings.index') : Redirect::route('items.settings.types.edit', ['type' => $type]);
        return $redirectRoute->with('status', $status);
    }
}
