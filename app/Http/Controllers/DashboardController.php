<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __invoke(Request $request)
    {
        $invoices = Invoice::query()->where('user_id', auth()->user()->id)
            ->when($request->filter, function ($query, $value) {
                return match ($value) {
                    'paid' => $query->whereNotNull('paid_at'),
                    'unpaid' => $query->whereNull('paid_at'),
                    default => abort(404),
                };
            })
            ->paginate(6);
        $invoicePending = auth()->user()->invoices()->where('paid_at', '=', null)->count();
        $debit = auth()->user()->invoices()->where('amount', '>=', 0)->get('amount')->sum('amount');
        $credit = auth()->user()->invoices()->where('amount', '<', 0)->get('amount')->sum('amount');
        $saldo = $debit + $credit;
        $tunnel = auth()->user()->tunnels()->get()->count();
        return view('dashboard', [
            'saldo' => formatRupiah($saldo),
            'tunnel' => $tunnel,
            'invoicePending' => $invoicePending,
            'invoices' => $invoices
        ]);
    }
}
