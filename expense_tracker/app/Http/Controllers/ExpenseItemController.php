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
}
