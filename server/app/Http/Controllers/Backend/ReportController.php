<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DateTime;
use App\Models\Order;

class ReportController extends Controller
{
    public function reportView()
    {
        return view('backend.report.report_view');
    }

    public function reportByDate(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required',
        ], [
            'date.required' => '年月日を選択して下さい。',
        ]);
        // return $request->all();
        $date = new DateTime($request->date);
        $formatDate = $date->format('Y年n月j日');
        // return $formatDate;
        $orders = Order::where('order_date', $formatDate)->latest()->get();

        return view('backend.report.report_show', compact('orders'));
    }

    public function reportByMonth(Request $request)
    {
        $validatedData = $request->validate([
            'year_name' => 'required',
            'month' => 'required',
        ], [
            'year_name.required' => '年を選択して下さい。',
            'month.required' => '月を選択して下さい。',
        ]);

        $orders = Order::where('order_year', $request->year_name)
            ->where('order_month', $request->month)
            ->latest()->get();

        return view('backend.report.report_show', compact('orders'));
    }

    public function reportByYear(Request $request)
    {
        $validatedData = $request->validate([
            'year' => 'required',
        ], [
            'year.required' => '年を選択して下さい。',
        ]);

        $orders = Order::where('order_year', $request->year)->latest()->get();

        return view('backend.report.report_show', compact('orders'));
    }
}
