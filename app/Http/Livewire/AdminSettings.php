<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class AdminSettings extends Component
{
    public $settings;
    public $inputs = [];


   public function mount()
    {
        $this->settings = Setting::first();
        $this->inputs = $this->settings ? $this->settings->toArray() : null;
    }

    public function render()
    {
        return view('livewire.admin-settings')->extends('layouts.master');
    }

    public function submit()
    {
        if(empty($this->inputs)) {
            session()->flash('error', 'Site title is required.');
            return;
        }
        $data = Validator::make($this->inputs, [
            'page_title' => 'required',
            'name' => 'required',
            'site_url' => 'required',
            'image_url' => 'required',
            'site_description' => 'required',
        ])->validate();

        $settings = $this->settings;
      
        if($settings) {
            $settings->update($data);
            session()->flash('success', 'Settings was successfully updated.');
        } else {
            Setting::create($data);
            session()->flash('success', 'Settings was successfully added.');
        }
     
        // $this->inputs = $this->settings->toArray();
        return redirect()->back();

    }

}
