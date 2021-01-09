<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use App\Model\Income;
use App\Model\DebtPayment;
use App\Model\Invoice;
use App\Model\InvoiceDetail;

class InvoiceHelper {
    public static function getTotal($invoiceId) {
        $total = Income::where('invoice_id', $invoiceId)->first();
        return $total ? $total->jumlah : 0;
    }

    public static function getDebtPaymentDetail($invoiceId) {
        return $payments = DebtPayment::where('invoice_id', $invoiceId)->get();
    }

    public static function getDebtPaymentTotal($invoiceId) {
        return $payments = DebtPayment::where('invoice_id', $invoiceId)->sum('bayar');
    }

    public static function getDetail($id){
        return $invoice = Invoice::find($id);
    }

    public static function getDetailInvoice($id)
    {
        return $jumlah = InvoiceDetail::where('invoice_id', $id)->sum('jual');
    }
}  