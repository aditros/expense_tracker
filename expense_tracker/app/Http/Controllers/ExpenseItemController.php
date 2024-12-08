<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExpenseItemController extends Controller
{
    public function index(Request $request)
    {
        $expenseItems = $request->user()->expenseItems()->with('category')->get();

        return view('expense_items.index', compact('expenseItems'));
    }

    public function createIndex(Request $request)
    {
        $categories = $request->user()->expenseCategories;
        return view('expense_items.edit', ['categories' => $categories]);
    }
    
    public function editIndex(Request $request, $id)
    {
        $expenseItem = $request->user()->expenseItems()->findOrFail($id);
        $categories = $request->user()->expenseCategories;
        return view('expense_items.edit', compact('expenseItem', 'categories'));
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:expense_categories,id',
            'cost' => 'required|numeric',
        ]);

        $request->user()->expenseItems()->create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'cost' => $request->cost,
            'purchase_time' => $request->purchase_time,
        ]);

        return redirect()->route('expense-items.index');
    }
    
    public function editPatch(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:expense_categories,id',
            'cost' => 'required|numeric',
        ]);

        $expenseItem = $request->user()->expenseItems()->findOrFail($id);
        $expenseItem->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'cost' => $request->cost,
            'purchase_time' => $request->purchase_time,
        ]);

        return redirect()->route('expense-items.index');
    }

    public function delete(Request $request, $id)
    {
        $expenseItem = $request->user()->expenseItems()->findOrFail($id);
        $expenseItem->delete();

        return redirect()->route('expense-items.index');
    }
}
