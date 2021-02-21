<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreditApplicationIndex extends Component
{
    public $partnerId;

    public $showUpdate, $showCreate;

    public function mount($partnerId)
    {
        $this->partnerId = $partnerId;
        $this->showUpdate = false;
        $this->showCreate = false;
    }

    public function render()
    {
        return view('livewire.credit-application-index');
    }

    public function create()
    {
        $this->showCreate = true;
    }

    public function cancelCreate()
    {
        $this->showCreate = false;
    }
}
