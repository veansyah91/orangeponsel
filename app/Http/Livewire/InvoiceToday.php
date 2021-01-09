<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Model\Invoice;
use App\Model\Income;

class InvoiceToday extends Component
{   
    public $outletId;
    public $tanggal;

    protected $listeners = [
        'getOutlet' => 'showOutlet',
        'newInvoice' => 'handleNewInvoice',
    ];

    public function mount($outletId)
    {
        $this->outletId = $outletId;

        date_default_timezone_set('Asia/Jakarta');
        $this->tanggal = Date('Y-m-d');
    }


    public function render()
    {
        
        $data = Invoice::where('updated_at', 'like', $this->tanggal . '%')->where('outlet_id', $this->outletId)->get();

        return view('livewire.invoice-today',[
            'data' => $data
        ]);
    }

    public function showOutlet($outletId)
    {
        $this->outletId = $outletId;
    }

    public function handleNewInvoice()
    {

    }
}
