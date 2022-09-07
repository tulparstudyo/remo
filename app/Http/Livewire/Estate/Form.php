<?php

namespace App\Http\Livewire\Estate;

use App\Models\Estate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\FileUploadConfiguration;

class Form extends Component
{
    use WithFileUploads;
    public $photo;

    public function render()
    {
        return view('livewire.estate.form');
    }
    public function mount( $id)
    {
        $this->state = [];
        global $request;
        $id = $request->route('id', false);
        if($id){
            if($row = Estate::find($id)){
                $this->state = $row->toArray();
                $this->state['id']= $id;
            }
        }
        if(!$this->state){
            $this->state['id'] = 0;
            $this->state['title'] = '';
            $this->state['contact'] = '';
            $this->state['phone'] = '';
            $this->state['embed'] = '';
            $this->state['mapurl'] = '';
            $this->state['longitude'] = 0;
            $this->state['latitude'] = 0;
            $this->state['price'] = 0;
            $this->state['description'] = '';
            $this->state['image'] = '';
            $this->state['country'] = '';
            $this->state['region'] = '';
            $this->state['constituency'] = '';
            $this->state['image'] = '';
            $this->state['county'] = '';
            $this->state['district'] = '';
            $this->state['postcode'] = '';
            $this->state['status'] = '';
        }
    }
    public function updateEstateInformation(){

        $row = Estate::find($this->state['id']);
        if(!$row){
            $row = new Estate();
        }

        $row->title = $this->state['title'];
        $row->contact = $this->state['contact'];
        $row->phone = $this->state['phone'];
        $row->embed = $this->state['embed'];
        $row->mapurl = $this->state['mapurl'];
        $row->price = $this->state['price'];
        $row->longitude = $this->state['longitude'];
        $row->latitude = $this->state['latitude'];
        $row->country = $this->state['country'];
        $row->region = $this->state['region'];
        $row->constituency = $this->state['constituency'];
        $row->county = $this->state['county'];
        $row->district = $this->state['district'];
        $row->postcode = $this->state['postcode'];
        $row->status = (int)$this->state['status']>0;
        if($this->photo){
            $row->image = \Storage::url($this->photo->storePublicly('images-estate', ['disk' => 'public']));
        }
        $row->save();
        $this->emit('saved');
        $this->emitTo('livewire-toast', 'show', 'Estate Saved Successfully');
    }

}
