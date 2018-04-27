<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Console\Commands\HttpRequest;
use Carbon\Carbon;
use App\Pool;
use App\NewNetwork;
use Auth;

class TotalBlocksPool extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blocks:pool';

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
        $this->poolApi('https://superiorcoinpool.com:8117/stats', '8117', 'superpool');
        sleep(2);
        $this->poolApi('https://superior.superpools.net/api/live_stats', '', 'superpools.net');
        sleep(2);
        $this->poolApi('https://superiorcoin.minandoando.com/api/live_stats', '', 'minandoando');
    }

    private function poolApi($url, $port, $name)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_PORT => $port,
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "postman-token: c869823c-d095-dbb4-d874-d7f2104d9076"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
            $stats = json_decode($response,true);
            $vars = $stats['pool']['blocks'];
            $index= 0;
            $getheight = false;
            $data = [
                'tx_hash' => '',
                'date' => '',
                'height' => '',
                'pool_name' => ''
            ];            
            if(count($vars) > 0){
                foreach($vars as $var){
                    if($index%2==0){
                        $last24hrs = intval(explode(':', $var)[1]);
                        $last24hrs = (Carbon::now()->timestamp($last24hrs));
                        if($last24hrs >= Carbon::now()->subHours(24)->toDateTimeString()) {
                            $data['tx_hash']= explode(':', $var)[0];
                            $data['date'] = $last24hrs;
                            $data['pool_name'] = $name;
                            $getheight = true;
                        }
                    }
                    if($getheight && $index%2==1){
                        $data['height'] = $var;
                        $getheight = false;
    
                        $prevent_duplicate = Pool::where('tx_hash', $data['tx_hash'])->first();
                        if (!$prevent_duplicate) {
                            $pool = new Pool;
    
                            $pool->tx_hash = $data['tx_hash'];
                            $pool->date = $data['date'];
                            $pool->pool_name = $data['pool_name'];
                            $pool->height = $data['height'];
                            $pool->save();
                            $this->line('Save...');
                        }
                        $this->line('Done!!..');
                    }
                    $index++;
                }
            }
        }
    }
}