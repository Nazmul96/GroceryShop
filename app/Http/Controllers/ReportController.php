<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Helper\ControllerHelper;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function reportGenerate(Request $request) : View 
    {
        $date_details = ControllerHelper::getDateDetails($request);

        dd($date_details);
        $totalReportData = Transaction::whereBetween('transaction_date', [$date_details['from_date'], $date_details['to_date']])
        ->where('type', 'income')
        ->orwhere('type', 'expense')
        ->get();

        dd($totalReportData);
        $totalIncome   = $totalReportData->where('type', 'income')->sum('amount');

        $totalExpenses = $totalReportData->where('type', 'expense')->sum('amount');
    
   
        $profitLoss = $totalIncome - $totalExpenses;

        return view('report.index',compact('date_details','totalIncome', 'totalExpenses', 'profitLoss','totalReportData'));
    }
}
