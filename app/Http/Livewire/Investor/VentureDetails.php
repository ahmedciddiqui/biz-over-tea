<?php

namespace App\Http\Livewire\Investor;

use App\Models\Investment;
use App\Models\VentureModel;
use Livewire\Component;

class VentureDetails extends Component
{
    public $venture;
    public $userInvestment = 0;

    public $investedUser;

    public function mount(VentureModel $venture)
    {
        $this->venture = $venture->load('investmentRequests');
        $this->userInvestment = Investment::where('venture_id', $venture->id)
            ->where('user_id', auth()->id())
            ->with('investor')
            ->sum('ticket');
        $this->investedUser = Investment::where('venture_id', $venture->id)
            ->with('investor')->get();

            //dd($this->investedUser );
    }
    public function render()
    {
        return view('livewire.investor.venture-details');
    }
}
