<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NotificationDropdown extends Component
{
    protected $listeners = ['refreshNotifications' => '$refresh'];

    public function markAsRead($notificationId){
        $user = auth()->user();
        $notification = $user->notifications()->where('id', $notificationId)->first();
        if ($notification) {
            $notification->markAsRead();
            $this->emit('refreshNotifications');
        }
    }

    public function markAllAsRead(){
        $user = auth()->user();
        $user->unreadNotifications->markAsRead();
        $this->emit('refreshNotifications');
    }
    public function render()
    {
        return view('livewire.notification-dropdown',[
            'unreadCount' => auth()->user()->unreadNotifications()->count(),
            'notifications' => auth()->user()->notifications()->latest()->take(10)->get(),
        ]);
    }
}
