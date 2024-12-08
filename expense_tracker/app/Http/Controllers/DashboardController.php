<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $expenseItemPieChartData = $request->user()->expenseItems()
            ->selectRaw('expense_categories.name as category, sum(cost) as cost')
            ->join('expense_categories', 'expense_items.category_id', '=', 'expense_categories.id')
            ->groupBy('category')
            ->get();
        $expenseItemPieChartDataCategories = $expenseItemPieChartData->pluck('category')->toArray();
        $expenseItemPieChartDataCosts = $expenseItemPieChartData->pluck('cost')->toArray();
        $expenseItems = $request->user()->expenseItems()->with('category')->get();
        return view('dashboard', compact('expenseItems', 'expenseItemPieChartDataCategories', 'expenseItemPieChartDataCosts'));
    }
}
