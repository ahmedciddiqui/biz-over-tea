<?php

namespace App\Http\Livewire\Investor;

use App\Models\Investment;
use App\Models\WithdrawalRequest;
use Livewire\Component;

class Dashboard extends Component
{
    public $totalInvestments;
    public $totalAmountInvested;
    public $pendingWithdrawals;
    public $approvedWithdrawals;
    public $venturesCount;

    public function mount()
    {
        $this->totalInvestments = Investment::where('user_id', auth()->id())->count();
        $this->totalAmountInvested = Investment::where('user_id', auth()->id())->sum('ticket');
        $this->pendingWithdrawals = WithdrawalRequest::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->count();
        $this->approvedWithdrawals = WithdrawalRequest::where('user_id', auth()->id())
            ->where('status', 'approved')
            ->count();
        $this->venturesCount = Investment::where('user_id', auth()->id())
            ->distinct('venture_id')
            ->count('venture_id');
    }
    public function render()
    {
        return view('livewire.investor.dashboard');
    }
}
