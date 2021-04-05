<?php

namespace App\Http\Livewire;

use Livewire\Component;

class InvoiceClaimIndex extends Component
{
    public $showUpdate, $showCreate;

    public function mount()
    {
        $this->showUpdate = false;
        $this->showCreate = false;
    }

    public function render()
    {
        return view('livewire.invoice-claim-index');
    }
}
