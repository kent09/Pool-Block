<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Console\Commands\HttpRequest;
use Carbon\Carbon;
use App\Pool;
use App\NewNetwork;
use App\NewPool;
use App\Minandoando;
use Auth;

class Minandoandos extends Command
{
    protected $count = 0;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'minandoando:blockspool';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Save total blocks pool within 24hrs from pool blocks';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // $this->line('Getting started...');
        // \App\Minandoando::query()->truncate();
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://superiorcoin.minandoando.com/api/live_stats",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "postman-token: 2e7df4b8-bcb9-9be1-9f6d-f1cab7e25516"
            ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
            $data = json_decode($response, true);
            $vars = $data['pool']['blocks'];
            $height = $vars[count($vars) -1];
            $index = 0;
            $holderHeight = '';
            $oldHeight = NewNetwork::orderBy('block', 'asc')->first();
            foreach($vars as $var){
                if($index%2==1){
                    if(intval($oldHeight->block) < intval($var)){
                        $this->count++;
                        $holderHeight = $var;
                        $newpool = new Minandoando;
                        $newpool->height = $holderHeight;
                        $newpool->save();
                    }else{
                        dump($holderHeight); break;
                    }
                }$index++;
            }
            $loop = $this->loopPage($height);
            // dump($loop, count($vars) / 2);
        }
    }

    public function loopPage($lastHeight)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://superiorcoin.minandoando.com/api/get_blocks?height=".$lastHeight."",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "postman-token: 16f34b3b-7147-2b2a-6742-1b3cfcfae724"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
            $getBlocks = json_decode($response, true);
            $index = 0;
            $stop = false;
            $holderHeight = '';
            $oldHeight = NewNetwork::orderBy('block', 'asc')->first();
            foreach($getBlocks as $getBlock){
                if($index%2==1){

                    if(intval($oldHeight->block) < intval($getBlock)){
                        $this->count++;
                        $holderHeight = $getBlock;
                        $newpool = new Minandoando;
                        $newpool->height = $getBlock;
                        $newpool->save();
                    }else{
                        $stop = true;
                        dump($getBlock); break;
                    }
                }$index++;
                
            }
            if(!$stop){
                $this->loopPage($holderHeight);
            }
            return $this->count;
        }
    }
}