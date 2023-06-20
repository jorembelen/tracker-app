<?php

namespace App\Http\Livewire;

use App\Models\TrackedData;
use App\Models\Tracking;
use Livewire\Component;
use App\Models\Setting;
use Illuminate\Support\Facades\Config;

class TrackerComponent extends Component
{
    public $url;
    public $link;
    public $locations;

    public function mount()
    {
        $this->link = $this->getUrl();
        $this->locations = $this->getLocations();

        // Retrieve the site settings from the database
        $settings = Setting::first();

        // Update the site title and description
        if ($settings) {
            Config::set('app.name', $settings->name);
            Config::set('app.title', $settings->page_title);
            Config::set('app.description', $settings->site_description);
            Config::set('app.url', $settings->site_url);
            Config::set('app.image_url', $settings->image_url);
        }
    }

    public function render()
    {   
        return view('livewire.tracker-component')->extends('layouts.master');
    }

    public function getUrl()
    {
        $link = Tracking::whereSessionId(request()->session()->getId())->first();
        if ($link) {
            return route('show.image', $link->short_url);
        }
        return null;
    }

    public function getLocations()
    {
        $link = Tracking::whereSessionId(request()->session()->getId())->first();
        if ($link) {
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
