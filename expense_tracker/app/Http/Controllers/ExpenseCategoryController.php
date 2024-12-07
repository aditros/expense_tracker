<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller
{
    public function index(Request $request)
    {
        $expenseCategories = $request->user()->expenseCategories;

        return view('expense_categories.index', compact('expenseCategories'));
    }

    public function createIndex(Request $request)
    {
        return view('expense_categories.edit');
    }
    
    public function editIndex(Request $request, $id)
    {
        $expenseCategory = $request->user()->expenseCategories()->findOrFail($id);
        return view('expense_categories.edit', compact('expenseCategory'));
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $request->user()->expenseCategories()->create([
            'name' => $request->name,
        ]);

        return redirect()->route('expense-categories.index');
    }
    
    public function editPatch(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $expenseCategory = $request->user()->expenseCategories()->findOrFail($id);
        $expenseCategory->update([
            'name' => $request->name,
        ]);

        return redirect()->route('expense-categories.index');
    }

    public function delete(Request $request, $id)
    {
        $expenseCategory = $request->user()->expenseCategories()->findOrFail($id);
        $expenseCategory->delete();

        return redirect()->route('expense-categories.index');
    }
}
