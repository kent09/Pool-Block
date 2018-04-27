<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Network;
use App\NewNetwork;
use Auth;

class NewNetworks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'new:network';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sample';

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
        $this->line('Getting started...');
        \App\NewNetwork::query()->truncate();
        $network = $this->network(0);
        // dd($network);
        // $l ='23:57:53';
        // $k = '01:00:00:00';
        // if( strlen($l) < strlen($k)){
        //     echo 'okay';
        // }else{
        //     echo 'bad';
        // }
    }

    public function network($page){
        $data = $this->GetUnder24Hours($page);
        $data = json_decode($data, true);
        
        // $truncate = new NewNetwork;
        // $truncate->truncate();
        
        foreach($data['data']['blocks'] as $dat){
            $qwe = count((explode(':', $dat['age'])));
            if($qwe < 4){
                
                $newNetwork = new NewNetwork;
                $newNetwork->block = $dat['height'];
                $newNetwork->timestamps_utc = $dat['timestamp_utc'];
                $newNetwork->age = $dat['age'];
                $newNetwork->save();
                $this->line('Successfully saved!');
            }else{
                return;
            } 
        }
        $this->network($page+1);
        
    }

    private function GetUnder24Hours($page){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_PORT => "8081",
        CURLOPT_URL => "http://superior-coin.com:8081/api/transactions?page=".$page."&limit=100",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "postman-token: e92dc142-7f9f-504c-7b1c-0a27814ee093"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        return $response;
        }
    }
}