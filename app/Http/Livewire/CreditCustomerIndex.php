<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreditCustomerIndex extends Component
{
    public $showUpdate, $showCreate;

    public function mount()
    {
        $this->showUpdate = false;
        $this->showCreate = false;
    }

    public function render()
    {
        return view('livewire.credit-customer-index');
    }

    public function showCreate()
    {
        $this->showCreate = true;
    }

    public function cancelCreate()
    {
        $this->showCreate = false;
    }
}
