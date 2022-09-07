<?php

namespace App\Http\Livewire\Meeting;

use App\Models\Meeting;
use App\Models\User;
use Livewire\Component;

class Form extends Component
{
    public $selected;
    public function mount( $id)
    {
        $this->state = [];
        global $request;
        $id = $request->route('id', false);
        if($id){
            if($row = Meeting::find($id)){
                $this->state = $row->toArray();
                $this->state['id']= $id;
            }
        }
        if(!$this->state){
            $this->state['id'] = 0;
            $this->state['user_id'] = 0;
            $this->state['customer_id'] = 0;
            $this->state['estate_id'] = 0;
            $this->state['start_at'] = '';
            $this->state['end_at'] = '';
            $this->state['duration'] = '';
            $this->state['description'] = '';
            $this->state['status'] = null;
        }
    }
    public function render()
    {
        $this->selected_values();
        return view('livewire.meeting.form');
    }
    public function selected_values(){
        $this->selected['user_id'] = '';
        $this->selected['estate_id'] = '';
        $this->selected['customer_id'] = '';
        if($this->state['user_id']){
            $row = User::find($this->state['user_id']);
            //print_r($row);
            if($row){
                $this->selected['user_id'] = $row->name;
            }
        }
    }
    public function updateMeetingInformation(){

        $row = Meeting::find($this->state['id']);
        if(!$row){
            $row = new Meeting();
        }

        $row->user_id = $this->state['user_id'];
        $row->customer_id = $this->state['customer_id'];
        $row->estate_id = $this->state['estate_id'];
        $row->start_at = $this->state['start_at'];
        $row->end_at = $this->state['end_at'];
        $row->duration = $this->state['duration'];
        $row->description = $this->state['description'];
        $row->status = (int)$this->state['status']>0;

        $row->save();
        $this->state['id'] = $row->id;
        $this->emit('saved');
        $this->emitTo('livewire-toast', 'show', 'Estate Saved Successfully');
    }

}
