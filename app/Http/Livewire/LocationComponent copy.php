<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tracking;
use Illuminate\Http\Request;
use Adrianorosa\GeoLocation\GeoLocation;
use Jenssegers\Agent\Facades\Agent;

class LocationComponent extends Component
{
    public $url;
    public $latitude;
    public $longitude;

    protected $listeners = ['got-user-location' => 'setUserLocation'];

    public function setUserLocation($position)
    {
        $this->latitude = $position['latitude'];
        $this->longitude = $position['longitude'];
    }

    public function getUserLocation()
    {
        $this->dispatchBrowserEvent('get-user-location');
    }

    public function mount()
    {
        $this->dispatchBrowserEvent('component-loaded');
    }

    public function render()
    {
        return view('livewire.location-component');
    }
}
