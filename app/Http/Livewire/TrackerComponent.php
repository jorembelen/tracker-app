<?php

namespace App\Http\Livewire;

use App\Models\TrackedData;
use App\Models\Tracking;
use Livewire\Component;

class TrackerComponent extends Component
{
    public $url;
    public $link;
    public $locations;

    public function mount()
    {
            $this->link = $this->getUrl();
            $this->locations = $this->getLocations();
    }

    public function render()
    {
        return view('livewire.tracker-component');
    }

    public function getUrl()
    {
        $link = Tracking::whereSessionId(request()->session()->getId())->first();
        if($link) {
            return route('show.image', $link->short_url);
        }
        return null;
    }
    
    public function getLocations()
    {
        $link = Tracking::whereSessionId(request()->session()->getId())->first();
        if($link) {
            return TrackedData::whereTrackingId($link->id)->latest()->get();
        }
        return [];
    }

    public function submit()
    {
        $data = $this->validate([
            'url' => 'required|url'
        ]);

        $code = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 6);
        $data['short_url'] = $code;
        $data['session_id'] = request()->session()->getId();
        Tracking::create($data);
        $this->url = null;
        $this->link = $this->getUrl();
        session()->flash('success', 'Data submitted.');
        return redirect()->back(); 
    }

    public function regenerate()
    {
        $link = Tracking::whereSessionId(request()->session()->getId())->first();
        $link->data()->delete();
        $link->delete();
        $this->link = null;
        $this->locations = [];
    }

    public function copyToClipboard()
    {
        $this->dispatchBrowserEvent('copy-to-clipboard', $this->link);
        $this->render();
    }

}
