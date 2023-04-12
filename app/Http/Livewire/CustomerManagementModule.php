<?php

namespace App\Http\Livewire;

use App\Mail\mailsupport;
use App\Models\Customer;
use App\Models\Issue;
use App\Models\Cutomer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

use Illuminate\Support\Facades\Mail;

class CustomerManagementModule extends Component
{
    public $details;
    public $subject;

    public function submitted()
    {
        $this->validate([
            'subject' => 'required|max:20',
            'details' => 'required|max:600',
        ]);

        Issue::create([
            'user_id' => auth()->user()->id,
            'status' => 'Submitted',
            'subject' => $this->subject,
            'details' => $this->details,
        ]);

        Mail::to(auth()->user()->email)->send(new mailsupport($this->subject, $this->details));
        $this->details = "";
        $this->subject = "";
    }


    public $issues;
    public $openToclosed = false;
    public $showMain = 0;
    public $IDtoclose;
    public function toclose($id)
    {
        $this->IDtoclose = $id;
        $this->openToclosed = true;
    }

    public function closed()
    {
        Issue::find($this->IDtoclose)->update(['status' => 'closed']);
        foreach (User::all() as $key => $user) {
            if ($user->getAdmin) {
                Mail::to(User::find($user->getAdmin->user_id)->email)
                ->send(new mailsupport(
                    'The custommer ['.auth()->user()->name.'] has closed this issue',
                    'The custommer has closed  issue',
                ));
            }
        }
        $this->IDtoclose = null;
        $this->openToclosed = false;
    }

    public function render()
    {
        $this->issues = auth()->user()->getIssue->sortByDesc("id");;
        return view('livewire.customer-management-module');
    }
}
