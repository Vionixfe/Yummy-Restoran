<?php

namespace App\Http\Controllers\Backend;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTransactions = Transaction::count();
        $totalPending = Transaction::where('status', 'pending')->count();
        $totalSuccess = Transaction::where('status', 'success')->count();
        $totalFailed = Transaction::where('status', 'failed')->count();
        $latestTransactions = Transaction::orderBy('created_at', 'desc')->take(5)->get();

            $dates = [];
            foreach ($latestTransactions as $transaction) {
                $dates[] = date('Y-m', strtotime($transaction->date));
            }
            $dates = array_unique($dates);
            sort($dates);
    
            return view('backend.dashboard.index', compact(
                'totalTransactions',
                'totalPending',
                'totalSuccess',
                'totalFailed',
                'latestTransactions',
                'dates'
            ));
        }
}
