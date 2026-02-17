<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use App\Notifications\SystemNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class Investors extends Component
{

    public $investors;

     public $selectedInvestor = null;

   public function showInvestorDetails($investorId)
    {
        $this->selectedInvestor = User::role('Investor')
            ->with('investments.venture')
            ->find($investorId);
    }


    public function closeModal()
    {
        $this->selectedInvestor = null;
    }

    public function updateApproval($userId, $value)
    {
        $investor = User::role('Investor')->findOrFail($userId);

        $investor->is_approved = (int)$value === 1;
        $investor->save();

        // Optional: notify investor when approved
        if ($investor->is_approved) {
            Notification::send($investor, new SystemNotification(
                'Account Approved',
                'Your account has been approved by admin. You can now access your dashboard.',
                'Go to Dashboard',
                route('investor.dashboard'),
                true
            ));
        }

        session()->flash('message', 'Investor status updated.');
    }

    public function render()
    {
        $this->investors = User::role('Investor')->with('investments.venture')->where('is_approved', true)->orderBy('created_at', 'desc')->get();
        return view('livewire.admin.investors');
    }
}
