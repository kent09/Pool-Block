<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pool;
use App\Network;
use App\ThirtyDay;
use App\NewNetwork;
use App\NewPool;
use App\Minandoando;
use App\Cryptominero;
use App\NewThirty;
use Carbon\Carbon;
use DB;

class ViewController extends Controller
{
    public function index()
    {
        // POOLS
        // $superpool = Pool::where('pool_name', '=', 'superpool')->where('date', '>=', now()->subHours(24)->toDateTimeString())->count();
        // $superpoolsNet = Pool::where('pool_name', '=', 'superpools.net')->where('date', '>=', now()->subHours(24)->toDateTimeString())->count();
        // $minandoando = Pool::where('pool_name', '=', 'minandoando')->where('date', '>=', now()->subHours(24)->toDateTimeString())->count();

        // NETWORK
        // $network = Network::where('timestamp_utc', '>=', now()->subHours(24)->toDateTimeString())->count();

        // PERCENTAGE FOR EVERY POOL
        // $superpool_pool = ($superpool / $network) * 100;
        // $superpoolsNet_pool = ($superpoolsNet / $network) * 100;
        // $minandoando_pool = ($minandoando / $network) * 100;
        // dd(number_format($superpool_pool, 2));
        // dd(number_format($superpoolsNet_pool, 2));
        // dd(number_format($minandoando_pool, 2));

        // TOTAL POOL BLOCKS SUMMARY
        // $summary = ($superpool + $superpoolsNet + $minandoando);
        // dd($summary);

        // UNACCOUNTED
        // $unaccountedTotal = ($network - $summary);
        // $unaccountedPercent = ($unaccountedTotal / $network) * 100;
        // dd($unaccountedTotal); Total of unaccounted.
        // dd(number_formats($unaccountedPercent, 2)); Total of unaccounted.

        // TOTAL NETWORK IN LAST 30 DAYS

        // $lastThrityDay = ThirtyDay::where('timestamps_utc', '>=', Carbon::now()->subDays(30)->toDateTimeString())->get(); // DATA IN LAST 30 DAYS.
        // $latestDates = ThirtyDay::orderBy('timestamps_utc', 'desc')->first(); // THE LASTEST DATE IN LAST 30 DAYS
        // $latestDate = now()->subDay();
        // $chuck_days = [];
        // for ($i = 0; $i < 30; $i++){
        //     $latest_date = $latestDate->subDays($i)->toDateTimeString();
        //     $countIn = ThirtyDay::where('timestamps_utc', '>=', $latest_date)->count();
        //     // dump($latest_date, $countIn);
        //     $chuck_days[$i] = $countIn;
        //     // array_unshift($chuck_days, $countIn);
        //     // dd($chuck_days[$i]);
        // }
        // dump($chuck_days);
        // dd($lastThrityDay);
        $last = NewThirty::whereNotNull('id')->orderBy('id', 'desc')->first();
        $data = $this->thrityDaysNetwork();
        // dump($data);
        return view('welcome', compact('data', 'last'));
    }

    public function poolStats($pool_name)
    {
        $pool = Pool::where('pool_name', '=', $pool_name)->where('date', '>=', now()->subHours(24)->toDateTimeString())->count();
        $network = Network::where('timestamp_utc', '>=', now()->subHours(24)->toDateTimeString())->count();
        $pool_percentage = ($pool / $network) * 100;

        return response()->json(compact('pool', 'pool_percentage', 'network', 'pool_name'));
    }

    public function networkStats()
    {
        $lastThrityDay = ThirtyDay::where('timestamps_utc', '>=', Carbon::now()->subDays(30)->toDateTimeString())->get(); 
        // $latestDate_start = now()->addDay();
        // $latestDate_end = now();
        $chuck_days = [];
        for ($i = 0; $i < 30; $i++){
            $countIn = 0;
            $latestDate_start = now();
            $latestDate_end = now()->subDay();
            $latest_start = $latestDate_start->subDays($i)->toDateTimeString();
            $latest_end = $latestDate_end->subDays($i)->toDateTimeString();
            $countIn = ThirtyDay::where('timestamps_utc', '>=', $latest_end)->where('timestamps_utc', '<=', $latest_start)->count();
            $chuck_days[$i] = [
                'latest_start' => $latest_start,
                'latest_end' => $latest_end,
                'count' => $countIn
            ];
        }

        return response()->json(compact('latestDate', 'chuck_days', 'latest_date', 'countIn'));
    }

    public function superiorcoinpool()
    {
        $newpool = NewPool::count();
        $minandoando = Minandoando::count();
        $cryptomineros = Cryptominero::count();
        $newNetwork = NewNetwork::count();

        $unaccountedTotal = $newNetwork - ($newpool + $minandoando + $cryptomineros);

        if($newNetwork !=0){
            $unaccountedPercent = ($unaccountedTotal / $newNetwork) * 100;
            $newpool_percentage = ($newpool / $newNetwork) * 100;
            $minan_percentage = ($minandoando / $newNetwork) * 100;
            $crypto_percentage = ($cryptomineros / $newNetwork) * 100;
        }else{
            $unaccountedPercent = 0;
            $newpool_percentage = 0;
            $minan_percentage = 0;
            $crypto_percentage = 0;
        }
        

        return response()->json(compact('newpool', 'newNetwork','newpool_percentage', 'minandoando', 'minan_percentage', 'cryptomineros', 'crypto_percentage', 'unaccountedTotal', 'unaccountedPercent'));
    }

    public function newNetwork()
    {
        $newNetwork = NewNetwork::count();

        return response()->json(compact('newNetwork'));
    }

    protected function thrityDaysNetwork()
    {
        $qweq = \DB::table('new_thirties')
                ->selectRaw('count(count) as totalhit')
                ->selectRaw('count as day')
                ->selectRaw('max(pool_timestamps) as today')
                ->groupBy('count')
                ->limit(7)
                ->get();
        return $qweq;
    }

    public function sortDate(Request $request) 
    {
        $timestamp = substr($request->date, 0, 10);

        $dt = Carbon::createFromTimestamp((int)$timestamp);

        // dump($dt);

        // $date = explode("-", $request->date);
        // $dt = Carbon::create($date[2], $date[0], $date[1]);
        $last = NewThirty::whereNotNull('id')->orderBy('id', 'desc')->first();

        $day = $dt->timestamp;
        $month = $dt->subMonth();

        $qweq = \DB::table('new_thirties')
                ->whereBetween('pool_timestamps',[$month->timestamp, $day])
                ->selectRaw('count(count) as totalhit')
                ->selectRaw('count as day')
                ->selectRaw('max(pool_timestamps) as today')
                ->groupBy('count')
                ->get();

        return response()->json(['data' => $qweq, 'last' => $last]);
    }

    public function sortYear() {

        $qweq = \DB::table('new_thirties')
                ->selectRaw('Year(FROM_UNIXTIME(pool_timestamps)) as year')
                ->selectRaw('count(count) as totalhit')
                ->orderBy('year', 'desc')
                ->groupBy('year')
                ->get();

        return response()->json($qweq);
    }


}