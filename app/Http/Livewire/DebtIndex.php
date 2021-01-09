<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\DB;

use App\Model\DebtPayment;
use App\Model\Outlet;
use App\Model\PaymentStatus;

class DebtIndex extends Component
{
    public $outletId, $outlets, $outlet, $selectOutlet;

    public function mount(){
        $this->outlets = Outlet::all();

        $this->outletId = $this->outlets[0]->id;
        $this->selectOutlet = $this->outlets[0]->id;
    }

    public function render()
    {
        
        $remains = DB::table('payment_statuses')
                        ->join('invoices','invoices.id','=','payment_statuses.invoice_id')
                        ->join('customers','customers.id','=','invoices.customer_id')
                        ->where('invoices.outlet_id', $this->selectOutlet)
                        ->where('payment_statuses.sisa', '<', 0)->get();

        // dd($remains);

        return view('livewire.debt-index',[
            'remains' => $remains,
        ]);
    }

    public function debtPay($invoiceId)
    {
        $payment = PaymentStatus::where('invoice_id', $invoiceId)->first();
    }

}
