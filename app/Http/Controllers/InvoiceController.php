<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Services\TripayService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class InvoiceController extends Controller
{
    public function __construct(TripayService $tripayService)
    {
        $this->tripayService = $tripayService;
    }

    public function create()
    {
        $invoices = Invoice::query()->select('reference', 'merchant_ref', 'amount', 'created_at', 'paid_at', 'description', 'status')
            ->where('user_id', auth()->user()->id)
            ->get('reference', 'merchant_ref', 'amount', 'created_at', 'paid_at', 'description', 'status');
        $payments = $this->tripayService->getPayments();

        $debit = auth()->user()->invoices()->where('amount', '>=', 0)->get('amount')->sum('amount');
        $credit = auth()->user()->invoices()->where('amount', '<', 0)->get('amount')->sum('amount');
        $saldo = $debit + $credit;
        return view('topup.transaksi', [
            'invoices' => $invoices,
            'payments' => $payments,
            'saldo' => formatRupiah($saldo)
        ]);
    }

    public function show($reference)
    {
        $pay = $this->tripayService->detailsTransaction($reference);
        return view('topup.invoice', [
            'pay' =>  $pay,
        ]);
    }

    public function store(Request $request)
    {
        if (empty($request->amount)) {
            throw ValidationException::withMessages([
                // 'server_id' => 'Pilih server terlebih dahulu',
                'amount' => 'Pilih jumlah saldo yang akan di topup',
                'method' => 'Pilih jenis pembayaran.',
                // 'price' => 'Silahkan pilih durasi sekaligus harga tunnel',
            ]);
            session()->flash('status', 'Permintaan Top Up gagal, silahkan ulangi');

            return to_route('topup.create');
        }

        // if ($request->user()->latestOfTransactionNotConfirmed) {
        //     throw ValidationException::withMessages([
        //         'method' => 'Selesaikan pembayaran Anda sebelumnya',
        //     ]);
        // }

        $amount = $request->amount;
        $method = $request->method;;
        $invoice = $this->tripayService->requestTransaction($amount, $method);
        auth()->user()->invoices()->create([
            'reference' => $invoice->reference,
            'merchant_ref' => $invoice->merchant_ref,
            'description' => 'Topup Saldo',
            'method' => $method
        ]);

        session()->flash('status', 'Invoice berhasil di buat, Silahkan lanjutkan pembayaran');
        return to_route('topup.show', $invoice->reference);
    }
}
