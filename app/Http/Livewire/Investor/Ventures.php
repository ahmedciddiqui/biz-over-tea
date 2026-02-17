<?php

namespace App\Http\Livewire\Investor;

use App\Models\investment;
use App\Models\InvestmentRequest;
use App\Models\User;
use App\Models\VentureModel;
use App\Models\WithdrawalRequest;
use App\Notifications\SystemNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class Ventures extends Component
{
    public $ventures;
    public $showModal = false;
    public $selectVenture;
    public $ticket;
    public $withdrawAmount = 0;
    public $selectedVentureId = null;
    public $showWithdrawModal = false;

    protected $rules = [
        'ticket' => 'required|numeric'
    ];

    public function invest($ventureId)
    {
        $this->selectVenture = VentureModel::findOrFail($ventureId);
        $this->amount = $this->selectVenture->min_investment;
        $this->showModal = true;

    }

    public function requestInvestment($ventureId)
    {
        $vantures = VentureModel::findOrFail($ventureId);
        $existingRequest = InvestmentRequest::where('user_id', Auth::id())
            ->where('venture_id', $ventureId)
            ->first();
        /*if ($existingRequest) {
            $message = match($existingRequest->status) {
                'pending' => 'You have a pending investment request for this venture.',
                'approved' => 'Your investment request for this venture has been approved.',
                'rejected' => 'Your investment request for this venture has been rejected.',
                default => 'You have already requested investment for this venture.',
            };
            session()->flash('error', $message);

        } */

        InvestmentRequest::create([
            'user_id' => Auth::id(),
            'venture_id' => $ventureId,
            'status' => 'pending'
        ]);
        session()->flash('message', 'Investment request sent successfully.');

        $admins = User::role('Admin')->first();
        Notification::send(
            $admins,
            new SystemNotification(
                'New Investment Request',
                'An investor has requested to invest in your venture: ' . $vantures->name,
                'Investment Requests',
                route('admin.investment.requests'),
                true
            )
        );
    }

    public function saveInvestment()
    {
        $venture = $this->selectVenture->fresh();
        $this->validate([
            'ticket' => 'required|numeric|min:' . $venture->min_investment_ticket,
        ], [
            'ticket.min' => "Minimum   {$venture->min_investment_ticket} ticket to invest. ",
        ]);

        // Step 2: Check venture-specific max
        if ($venture->max_investment_ticket && $this->ticket > $venture->max_investment_ticket) {
            $this->addError('ticket', "Maximum {$venture->max_investment_ticket} ticket allowed to investment .");
            return;
        }
        
        // Get total tickets already invested by this user in this venture
        $userTotalTickets = Investment::where('user_id', auth()->id())
            ->where('venture_id', $venture->id)
            ->sum('ticket');

        // Check max investment per user (venture-wise)
        if ($venture->max_investment_ticket &&
            ($userTotalTickets + $this->ticket) > $venture->max_investment_ticket) {

            $remainingAllowed = $venture->max_investment_ticket - $userTotalTickets;

            if ($remainingAllowed <= 0) {
                $this->addError(
                    'ticket',
                    "You have already reached the maximum investment limit ({$venture->max_investment_ticket} tickets) for this venture."
                );
            } else {
                $this->addError(
                    'ticket',
                    "You can invest only {$remainingAllowed} more tickets for this venture."
                );
            }

            return;
        }


        $remaining = $venture->total_ticket_quantity - $venture->funds_raised;
        //dd($remaining);
        if ($this->ticket > $remaining) {
            $this->addError('ticket', "You can only invest up to ₹{$remaining}.");
            return;
        }


        Investment::create([
            'user_id' => auth()->user()->id,
            'venture_id' => $this->selectVenture->id,
            'ticket' => $this->ticket
        ]);

        $this->selectVenture->increment('funds_raised', $this->ticket);

        if ($this->selectVenture->funds_raised >= $this->selectVenture->total_ticket_quantity) {
            $this->selectVenture->status = 'closed';
            $this->selectVenture->save();
        }

        $this->reset(['ticket', 'showModal']);
        session()->flash('message', 'Investment saved successfully.');
    }

    public function confirmWithdraw($ventureId)
    {
        $this->selectedVentureId = $ventureId;
        $this->withdrawAmount = 0;
        $this->showWithdrawModal = true;
    }

    public function sendWithdrawRequest()
    {
        $this->validate([
            'withdrawAmount' => 'required|numeric|min:1',
        ]);

        $investment = Investment::where('venture_id', $this->selectedVentureId)
            ->where('user_id', auth()->id())
            ->first();

        if (!$investment || $this->withdrawAmount > $investment->amount) {
            session()->flash('error', 'Invalid withdrawal amount.');
            return;
        }

        WithdrawalRequest::create([
            'user_id' => auth()->id(),
            'venture_id' => $this->selectedVentureId,
            'amount' => $this->withdrawAmount,
        ]);

        $this->showWithdrawModal = false;
        session()->flash('message', 'Withdrawal request sent successfully. Waiting for admin approval.');
    }
    public function render()
    {
        //$this->ventures = VentureModel::where('status', 'active')->where('commit_date', '>=', date('Y-m-d'))->orderBy('commit_date')->get();
        $this->ventures = VentureModel::where('status', 'active')->orderBy('commit_date')->get();
        //dd($this->ventures);    
        return view('livewire.investor.ventures');
    }
}
