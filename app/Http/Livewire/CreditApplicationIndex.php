<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreditApplicationIndex extends Component
{
    public $partnerId;

    public $showUpdate;

    public function mount($partnerId)
    {
        $this->partnerId = $partnerId;
    }

    public function render()
    {
        return view('livewire.credit-application-index');
    }
}
