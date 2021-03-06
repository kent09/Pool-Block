<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Network;
use Auth;

class TotalBlocksNetwork extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blocks:network';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Save total blocks network within 24hrs from blockchain';

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

        $stats = file_get_contents('http://superior-coin.com:8081/api/networkinfo');
        $stats = json_decode($stats);
        $stats = $stats->data;
        $current_height = $stats->height;

        $good = true;
        $last24Hour = now()->subHours(24)->timestamp;
        while ($good == true){
            $data = $this->currentHeight($current_height);
            if ($data->err == ''){
                $response = $data->response;
                if ($response->status == 'success'){
                    if ($response->data->timestamp >= $last24Hour){
                        dump($response->data->block_height, "Success within 24Hour");
                        foreach ($response->data->txs as $tx){
                            $network = Network::where('hash', $tx->tx_hash)->first();
                            if ($network == null){
                                $network = new Network;
                                $network->block_height = $response->data->block_height;
                                $network->current_height = $current_height;
                                $network->hash = $tx->tx_hash;
                                $network->size = $tx->tx_size;
                                $network->timestamp_utc = $response->data->timestamp_utc;
                                $network->save();
                                $good = true;
                            } else {
                                $good = false;
                                break;
                            }                            
                        }                        
                    } else {
                        dump($response->data->block_height, "Success after 24Hour");
                        $good = false;
                    }                    
                    $current_height--;
                } else {
                    dump("Failed");
                    $good = true;
                    $current_height--;
                }
            }
        }        
    }

    private function currentHeight($height)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_PORT => "8081",
        CURLOPT_URL => "http://superior-coin.com:8081/api/block/".$height,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "postman-token: 88147d01-622c-438d-89d7-76c0d2b8ba44"
        ),
        ));

        $response = curl_exec($curl);
        $response = json_decode($response, true);
        $err = curl_error($curl);
        $data = [
            'response' => $response,
            'err' => $err
        ];

        $data = json_encode($data);
        $data = json_decode($data);
        return ($data);
    }
}