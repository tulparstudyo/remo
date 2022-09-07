<?php

namespace App\Http\Livewire\Customer;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Form extends Component
{
    public function mount( $id)
    {
        $this->state = [];
        global $request;
        $id = $request->route('id', false);
        if($id){
            if($row = Customer::find($id)){
                $this->state = $row->toArray();
                $this->state['id']= $id;
            }
        }
        if(!$this->state){
            $this->state['id'] = 0;
            $this->state['title'] = '';
            $this->state['firstname'] = '';
            $this->state['lastname'] = '';
            $this->state['phone'] = '';
            $this->state['email'] = '';
            $this->state['description'] = '';
        }
    }

    public function render()
    {
        return view('livewire.customer.form');
    }
    public function updateCustomerInformation(){

        $row = Customer::find($this->state['id']);
        if(!$row){
            $row = new Customer();
        }
        $row->title = $this->state['title'];
        $row->firstname = $this->state['firstname'];
        $row->lastname = $this->state['lastname'];
        $row->phone = $this->state['phone'];
        $row->email = $this->state['email'];
        $row->description = $this->state['description'];
        $row->save();

        $this->emit('saved');
        $this->emit('refresh-navigation-menu');
        $this->emitTo('livewire-toast', 'show', 'Customer Saved Successfully');
    }

}
