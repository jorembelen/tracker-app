<?php

namespace App\Http\Controllers;

use App\Models\Tracking;
use Illuminate\Http\Request;
use Adrianorosa\GeoLocation\GeoLocation;
use Jenssegers\Agent\Facades\Agent;

class TrackerController extends Controller
{
    
    public function tracker(Request $request, $value)
    {
        $link = Tracking::whereShortUrl($value)
        ->first();
    if($link) {
        // $ip = '51.252.76.206';
        $ip = $request->ip();
        $location = GeoLocation::lookup($ip)->toArray();
        if(Agent::isDesktop()) {
            $device = 'desktop';
        } elseif(Agent::isPhone()) {
            $device = 'mobile';
        } elseif(Agent::isRobot()) {
            $device = 'robot';
        }

        $link->data()->create([
            'ip' => $ip,
            'city' => $location['city'],
            'region' => $location['region'],
            'country' => $location['country'],
            'latitude' => $location['latitude'],
            'longitude' => $location['longitude'],
            'device' => $device,
        ]);
        return redirect($link->url);
    }
    return redirect()->route('home')->withError('Sorry, this link is not working.');
    }

}
