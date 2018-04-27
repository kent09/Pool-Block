<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\ThirtyDay;
use Carbon\Carbon;
use Auth;

class ThiryDaysNetwork extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'thirydays:network';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Save the total blocks network everyday within 30 days from blockchain';

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
        $last30days = now()->subDays(30)->toDateTimeString();
        while ($good == true){
            $data = $this->currentHeight($current_height);

            if ($data->err == ''){
                $response = $data->response;
                if ($response->status == 'success'){
                    if ($response->data->timestamp >= $last30days){
                        dump($response->data->block_height, "Success within 30days");
                        foreach ($response->data->txs as $tx){
                            $network = ThirtyDay::where('hash', $tx->tx_hash)->first();
                            if ($network == null){
                                $timestamps = $response->data->timestamp_utc;
                                $network = new ThirtyDay;
                                $network->timestamps_utc = $timestamps;
                                $network->block_height = $response->data->block_height;
                                $network->current_height = $current_height;
                                $network->hash = $tx->tx_hash;
                                $network->size = $tx->tx_size;
                                $network->total_hit = 0;
                                $network->save();
                                $good = true;
                            } else {
                                $good = false;
                                break;
                            }                            
                        }                        
                    } else {
                        dump($response->data->block_height, "Success after 30days");
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