<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $reports = $request->user()->reports;

        return view('reports.index', compact('reports'));
    }

    public function createIndex(Request $request)
    {
        return view('reports.edit');
    }

    public function createPost(Request $request)
    {
        $reportType = $request->report_type;
        $year = $request->year;
        $expenseItems = $request->user()->expenseItems()->whereYear('purchase_time', $year);
        if ($reportType === 'monthly') {
            $startMonth = $request->start_month;
            $endMonth = $request->end_month;
            $expenseItems = $expenseItems->whereMonth('purchase_time', '>=', $startMonth)
                ->whereMonth('purchase_time', '<=', $endMonth);
        }
        $expenseItems = $expenseItems->get();
        $pdf = Pdf::loadView('reports.pdf', compact('expenseItems', 'year', 'reportType'));
        $filename = 'report-' . $reportType . '-' . $year . '-' . time() . '.pdf';
        $pdf->setPaper('a4', 'landscape')->setWarnings(false)->save( $filename, 'public');
        
        $request->user()->reports()->create([
            'description' => 'Report for ' . $reportType . ' expenses in ' . $year . ($reportType === 'monthly' ? ' from ' . $startMonth . ' to ' . $endMonth : ''),
            'file' => $filename,
            'user_id' => $request->user()->id,
        ]);
        return redirect()->route('reports.index');
    }

    public function delete(Request $request, $id)
    {
        $report = $request->user()->reports()->findOrFail($id);
        $report->delete();

        return redirect()->route('reports.index');
    }
}
