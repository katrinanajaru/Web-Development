<?php

namespace App\Http\Livewire;

use App\Models\Service;
use Livewire\Component;
use App\Models\Subservice;

class Book extends Component
{
    public $service;
    public $subservices=[];
    public $subservice;

    // public function mount($service,$subservice){

    //     $this->service=$service;
    //     $this->subservice=$subservice;
    // }

    public function render()
    {
        // return view('livewire.book');

        if(!empty($this->service)) {
            $this->subservices= Subservice::where('service_id', $this->service)->get();
        }
        return view('livewire.book')->withServices(Service::orderBy('name','Asc')->get());
    }
}
