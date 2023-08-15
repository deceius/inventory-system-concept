<?php

namespace App\Http\Controllers;

use App\Http\Requests\Expense\ExpenseStoreRequest;
use App\Models\Branch;
use App\Models\Expense;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

class ExpensesController extends Controller
{
    public function index(): View {
        return view('expenses.index');
    }

    public function create(): View {
        $branches = Branch::all();
        return view('expenses.create', ['branches' => $branches]);
    }

    public function store(ExpenseStoreRequest $request): RedirectResponse
    {
        $sanitized = $request->getSanitized();
        Expense::create($sanitized);
        return Redirect::route('expenses.index')->with('status', 'created');
    }

    public function fetch(Request $request): Response {
        $search = $request->input('search');
        $inactive = filter_var($request->input('inactive'), FILTER_VALIDATE_BOOLEAN);
        $types = Expense::orderBy('deleted_at', 'asc')
                    ->orderBy('id', 'desc');
        if ($search) {
            $types->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            });
        }
        $types->withTrashed();
        return response(['result' => $types->paginate(10)]);
    }

}
