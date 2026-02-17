<?php

namespace App\Http\Livewire\Admin;

use App\Models\Contact;
use App\Models\User;
use App\Notifications\SystemNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use Livewire\WithPagination;

class InvestorsRequest extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $investors;
    public $showStatusModal = false;
    public $selectedInvestorId;
    public $actionStatus;
    public $emailMessage;
    public $emailSubject;
    public $emailAddress;


    public function openStatusModal($investorId, $status)
    {
        $investor = Contact::findOrFail($investorId);
        //dd($investor, $status);
        if ($status === 'Approve') {
            $status = 1;
        } elseif ($status === 'Reject') {
            $status = 0;
        }
        $this->selectedInvestorId = $investorId;
        $this->actionStatus = $status;
        $this->emailMessage = '
            <p>Dear ' . e($investor->name) . ',</p>

            <p>
            We hope this message finds you well.
            </p>

            <p>
            ';

            if ($status) {
                    //  Approved message
                    $this->emailMessage .= '
            <p>
                We are pleased to inform you that your investor request has been
                <strong>approved</strong>.
            </p>

            <p>
                You may now log in to your dashboard to explore available opportunities
                and proceed with the next steps.
            </p>
            <p>
                <strong>Note:</strong> Your login username is your registered email address, and your temporary password is your registered mobile number.
            </p>
            ';
            } else {
                    // Rejected message (soft tone)
                    $this->emailMessage .= '
                <p>
                    Thank you for your interest in becoming an investor with us.
                </p>

                <p>
                    After careful review, we regret to inform you that your investor request
                    could not be approved at this time.
                </p>

                <p>
                    This decision does not necessarily reflect your eligibility in the future.
                    You are welcome to reapply or contact our support team for further clarification.
                </p>
                ';
                }

                ;

        $this->emailSubject = 'Your Investor Request has been ' . ($status ? 'Approved' : 'Rejected');
        $this->emailAddress = $investor->email;

        $this->showStatusModal = true;
    }

    public function confirmStatusChange()
    {
        $this->validate([
            'emailAddress' => 'required|email',
            'emailSubject' => 'required',
            'emailMessage' => 'required',
        ]);

        $investor = Contact::findOrFail($this->selectedInvestorId);
        //dd($investor, $this->actionStatus, $this->emailSubject, $this->emailMessage);

        // Update status
        $investor->update([
            'status' => $this->actionStatus == 1 ? 'approved' : 'rejected',
        ]);

        // Send email
        $emailData = [
            'subject' => $this->emailSubject,
            'message' => $this->emailMessage,
            'name' => $investor->name,
            'status' => $this->actionStatus == 1 ? 'approved' : 'pending',
        ];

        Notification::send($investor, new SystemNotification(
            $emailData['subject'],
            $emailData,
            'View Dashboard',
            route('investor.dashboard'),
            true,
            'website.emails.common_format'
        )); 
        if($this->actionStatus == 1){
            User::create([
                'name' => $investor->name,
                'email' => $investor->email,
                'password' => bcrypt($investor->phone),
                'is_approved' => true,
            ])->assignRole('Investor');
        }
        // Send Email


        $this->reset(['showStatusModal', 'emailMessage']);

        session()->flash('message', 'Email sent and status updated.');
    }


     public function render()
    {
        return view('livewire.admin.investors-request', [
            'contacts' => Contact::orderBy('created_at', 'desc')->paginate(10),
        ]);
    }
}
