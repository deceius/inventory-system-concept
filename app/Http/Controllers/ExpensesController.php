<?php

namespace App\Http\Controllers;

use App\Http\Requests\Expense\ExpenseStoreRequest;
use App\Http\Requests\Expense\ExpenseUpdateRequest;
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
        return view('expenses.create');
    }

    public function edit(Request $request, Expense $expense): View {
        return view('expenses.edit', ['expense' => $expense]);
    }

    public function delete(Request $request, Expense $expense): View {
        $expense->delete();
        return view('expenses.index');
    }


    public function update(ExpenseUpdateRequest $request, Expense $expense): RedirectResponse
    {
        $expense->fill($request->getSanitized());
        $expense->save();
        return Redirect::route('expenses.edit', ['expense' => $expense])->with('status', 'updated');
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
        $expenses = Expense::orderBy('deleted_at', 'asc')
                    ->orderBy('id', 'desc');
        if ($search) {
            $expenses->where(function ($query) use ($search) {
                $query->where('description', 'LIKE', '%' . $search . '%');
            });
        }
        if ($inactive) {
            $expenses->withTrashed();
        }
        return response(['result' => $expenses->paginate(10)]);
    }

}
