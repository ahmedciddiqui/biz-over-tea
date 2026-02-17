<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use App\Models\VentureModel;
use Livewire\Component;

class Dashboard extends Component
{
    public $totalVentures;
    public $totalInvestors;
    public $totalRequests;
    public $totalApprovedInvestments;
    public $totalFundsRaised;

    public function mount()
    {
        $this->totalVentures = VentureModel::count();
        $this->totalInvestors = User::role('Investor')->count();
        //$this->totalRequests = InvestmentRequests::count();
        //$this->totalApprovedInvestments = InvestmentRequests::where('status', 'approved')->count();
        $this->totalFundsRaised = VentureModel::sum('funds_raised') * VentureModel::value('one_ticket_amount');;
    }
    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
