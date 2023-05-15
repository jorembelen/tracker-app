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
        $ip = $request->ip();
        $location = GeoLocation::lookup($ip)->toArray();
        if(Agent::isDesktop()) {
            $device = 'desktop';
        } elseif(Agent::isPhone()) {
            $device = 'mobile';
        } elseif(Agent::isRobot()) {
            $device = 'robot';
        }
    
        $trackingInfo = $link->data()->create([
            'ip' => $ip,
            'city' => $location['city'],
            'region' => $location['region'],
            'country' => $location['country'],
            'latitude' => $location['latitude'],
            'longitude' => $location['longitude'],
            'device' => $device,
        ]);
      
        session()->put('url', [
            'value' => $link->url,
            'trackingId' => $trackingInfo->id,
        ]);

        dd(session()->get('url')['trackingId']);
        return redirect()->route('login');
    }
    return redirect()->route('home')->withError('Sorry, this link is not working.');
    }

}
