<?php

namespace App\Http\Livewire;

use App\Mail\mailsupport;
use App\Models\Customer;
use App\Models\Issue;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class AdminManagementModule extends Component
{
    public $details;
    public $subject;

    public $adminname;
    public $adminemail;
    public $adminpassword;

    // create admins 
    // not asked ,just for test mail
    public function addadmin()
    {
        $this->validate([
            'adminname'=>'required|max:20',
            'adminemail'=>'required|email',
            'adminpassword'=>'required|max:20',
        ]);
    }
    public function submitted()
    {
        $this->validate([
            'subject'=>'required|max:20',
            'details'=>'required|max:600',
        ]);

        Issue::find()->update([
            'user_id'=>auth()->user()->id,
            'status'=>'submitted',
            'subject'=>$this->subject,
            'details'=>$this->details,
        ]);
        $this->details="";
        $this->subject="";
    }
    
 
    public $issues;
    public $status;
    public $isdispaly=false;
 
  
    public $idtomakeChange;
    public function display($id)
    {
        $this->idtomakeChange=$id;
        $issues=Issue::find($this->idtomakeChange);
        $this->details=$issues->details;
        $this->subject=$issues->subject;
        $this->status=$issues->status;

        $this->isdispaly=true;
    }

    public function apply()
    {
        
      $issue=  Issue::find($this->idtomakeChange);
      $issue->update([
            'admin_id'=>auth()->user()->id,
            'status'=> $this->status,
            'subject'=>$this->subject,
            'details'=>$this->details,
      ]);
         
        Mail::to(User::find($issue->user_id)->email)
        ->send(new mailsupport(
            'Your issue [' .$this->subject.'] '.$this->status ,
            'The custommer support has manage this issue',
        ));

        $this->details="";
        $this->subject="";
        $this->isdispaly=false;

    }

    public function render()
    {
        $this->issues =Issue::all()->sortByDesc("id");
        return view('livewire.admin-management-module');
    }
}
