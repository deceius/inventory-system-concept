<?php

namespace App\Http\Controllers;

use App\Http\Requests\Branch\BranchStoreRequest;
use App\Http\Requests\Branch\BranchUpdateRequest;
use App\Models\Branch;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class BranchController extends Controller
{
    public function index(): View {
        return view('branch.index');
    }

    public function create(): View {
        return view('branch.create');
    }

    public function fetch(Request $request): Response {
        $branches = Branch::orderBy('is_active', 'desc')
                    ->orderBy('id', 'asc')
                    ->get();
        return response(['branches' => $branches]);
    }

    public function edit(Request $request, Branch $branch): View {
        return view('branch.edit', ['branch' => $branch]);
    }

    public function update(BranchUpdateRequest $request, Branch $branch): RedirectResponse
    {
        $branch->fill($request->validated());
        $branch->save();
        return Redirect::route('admin.branch.edit', ['branch' => $branch])->with('status', 'branch-updated');
    }

    public function activate(BranchUpdateRequest $request, Branch $branch): RedirectResponse
    {
        $branch->fill($request->validated());
        $branch->is_active = 1;
        return $this->updateActivation($branch->fill($request->validated()), 'branch-activated');
    }

    public function deactivate(BranchUpdateRequest $request, Branch $branch): RedirectResponse
    {
        $branch->fill($request->validated());
        $branch->is_active = 0;
        return $this->updateActivation($branch, 'branch-deactivated');
    }

    function updateActivation(Branch $branch, $status): RedirectResponse {
        $branch->save();
        $redirectRoute = $status == 'branch-deactivated' ? Redirect::route('admin.branch.index') : Redirect::route('admin.branch.edit', ['branch' => $branch]);
        return $redirectRoute->with('status', $status);
    }

    public function store(BranchStoreRequest $request): RedirectResponse
    {
        $sanitized = $request->getSanitized();
        $sanitized['created_by'] = Auth::user()->id;

        // Store the Branch
        $branch = Branch::create($sanitized);

        return Redirect::route('admin.branch.index')->with('status', 'branch-created');
    }

}
