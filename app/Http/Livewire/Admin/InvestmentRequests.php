<?php

namespace App\Http\Livewire\Admin;

use App\Notifications\SystemNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class InvestmentRequests extends Component
{
    public $requests;
    public $rejectModal = false;
    public $rejectReason = '';
    public $selectedRequestId = null;
    public $processingRequestId = null;

    public function approveRequest($requestId)
    {
        $this->processingRequestId = $requestId;
        $request = \App\Models\InvestmentRequest::findOrFail($requestId);
        $request->status = 'approved';
        $request->save();
        session()->flash('message', 'Investment request approved successfully.');
        Notification::send($request->Investor, new SystemNotification(
            'Investment Request Approved',
            'Your investment request for the venture "' . $request->Venture->name . '" has been approved.',
            'View Investment',
            route('investor.ventures'),
            true
        ));
    }

    public function rejectRequest()
    {
        $this->processingRequestId = $this->selectedRequestId;
        $request = \App\Models\InvestmentRequest::findOrFail($this->selectedRequestId);
        $request->update([
            'status' => 'rejected',
            'rejection_reason' => $this->rejectReason,
        ]);
        session()->flash('message', 'Investment request rejected successfully.');
        Notification::send($request->Investor, new SystemNotification(
            'Investment Request Rejected',
            'Your investment request for the venture "' . $request->Venture->name . '" has been rejected. Reason: ' . $this->rejectReason,
            'View Investment',
            route('investor.ventures'),
            true
        ));
        $this->rejectModal = false;
    }

    public function openRejectModal($requestId){
        $this->selectedRequestId = $requestId;
        $this->rejectModal = true;
        $this->rejectReason = '';
    }

    public function render()
    {   $this->requests = \App\Models\InvestmentRequest::with(['Investor', 'Venture'])->get();
        //dd($this->requests);    
        return view('livewire.admin.investment-requests');
    }
}
