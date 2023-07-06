<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class UsersController extends Controller
{


    protected $tiers = ['Admin', 'Manager', 'Team Lead', 'Team Member'];
    // Views

    public function index(): View {
        $branches = Branch::where('is_active', 1)->get();
        return view('users.index', ['branches' => $branches]);
    }

    public function create(): View {
        $branches = Branch::where('is_active', 1)->get();
        return view('users.create', ['branches' => $branches, 'tiers' => $this->tiers]);
    }

    public function edit(Request $request, User $user): View {
        $branches = Branch::where('is_active', 1)->get();
        return view('users.edit', ['user' => $user, 'branches' => $branches, 'tiers' => $this->tiers]);
    }


    // API Calls

    public function fetch(Request $request): Response {
        $search = $request->input('search');
        $branch = $request->input('branch');
        $inactive = filter_var($request->input('inactive'), FILTER_VALIDATE_BOOLEAN);
        $users = User::orderBy('is_active', 'desc')
                    ->orderBy('id', 'desc');
        if ($search) {
            $users->where(function ($query) use ($search, $branch) {
                $query->where('name', 'LIKE', '%' . $search . '%');
                $query->orWhere('email', 'LIKE', '%' . $search . '%');
            });
        }
        if ($branch){
            $users->where('branch_id', $branch);
        }
        if (!$inactive) {
            $users->where('is_active', !$inactive);
        }

        $users->with('branch');

        return response(['result' => $users->paginate(9)]);
    }

    public function store(UserStoreRequest $request): RedirectResponse
    {
        $sanitized = $request->getSanitized();
        User::create($sanitized);
        return Redirect::route('admin.users.index')->with('status', 'user-created');
    }

    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        $user->fill($request->validated());
        $user->save();
        return Redirect::route('admin.users.edit', ['user' => $user])->with('status', 'user-updated');
    }

    public function activate(UserUpdateRequest $request, User $user): RedirectResponse
    {
        $user->fill($request->validated());
        $user->is_active = 1;
        return $this->updateActivation($user->fill($request->validated()), 'user-activated');
    }

    public function deactivate(UserUpdateRequest $request, User $user): RedirectResponse
    {
        $user->fill($request->validated());
        $user->is_active = 0;
        return $this->updateActivation($user, 'user-deactivated');
    }

    function updateActivation(User $user, $status): RedirectResponse {
        $user->save();
        $redirectRoute = $status == 'user-deactivated' ? Redirect::route('admin.users.index') : Redirect::route('admin.users.edit', ['user' => $user]);
        return $redirectRoute->with('status', $status);
    }

}
