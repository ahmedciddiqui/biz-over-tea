<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class InvestorDetails extends Component
{
    public $selectedInvestor;

     public function mount($investorId)
    {
        $this->selectedInvestor = User::role('Investor')
            ->with('investments.venture')
            ->findOrFail($investorId);
    }
    public function render()
    {
        return view('livewire.admin.investor-details');
    }
}
