<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\NewThirty;
use DB;

class GetAllPoolData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:pool';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all data in the pool';

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
        \App\NewThirty::query()->truncate();
        $network = $this->network(0);
    }

    public function network($page){
        $data = $this->GetUnder24Hours($page);
        $data = json_decode($data, true);


        if(count($data['data']['blocks']) > 0 ){
            foreach($data['data']['blocks'] as $dat){
                $qwe = count((explode(':', $dat['age'])));
                $day = (explode(':', $dat['age'])[0]);

                if($day < "30"){
                    $this->storeData($dat, $qwe);
                }
            }
            $this->network($page+1);
        }
    }

    private function storeData($dat, $qwe) {
        $newthirty = new NewThirty;
        if($qwe < 4){
            $dat['age'] = "00:". $dat['age']; 
        }
        $r=explode(":",$dat['age'])[0];
        $newthirty->count = $r;
        $newthirty->day = $dat['height'];
        $newthirty->pool_timestamps = $dat['timestamp'];
        $newthirty->save();
        $this->line('Successfully saved!');
    }

    private function GetUnder24Hours($page){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_PORT => "8081",
        CURLOPT_URL => "http://superior-coin.info:8081/api/transactions?page=".$page."&limit=100",
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
