<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class QoreIDToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'qoreid:get-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate bearer token for QoreID';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('QoreID Token Generation Started');
        $getToken = Http::post(config('qoreid.baseUrl')."/token", [
            "clientId"  => config('qoreid.clientId'), 
        	"secret"    => config('qoreid.secretKey'),
        ]);
        if ($getToken->successful()) {
            $apiData = DB::table('api_data')->where('name', 'QoreID');
            if ($apiData->first()) {
                $apiData->update([
                    'token_type'    => $getToken->json('tokenType'), 
                    'access_token'  => $getToken->json('accessToken'), 
                    'expires_in'    => $getToken->json('expiresIn'),
                    'updated_at'    => now()
                ]);
                Log::info('QoreID Token Generated Successfully');
                return Command::SUCCESS;
            }
            DB::table('api_data')->insert([
                'name'          => 'QoreID',
                'token_type'    => $getToken->json('tokenType'), 
                'access_token'  => $getToken->json('accessToken'), 
                'expires_in'    => $getToken->json('expiresIn'),
                'created_at'    => now()
            ]);
            Log::info('QoreID Token Generated Successfully');
            return Command::SUCCESS;
        }
        Log::info('QoreID Token Generation Failed');
        return Command::FAILURE;
    }
}
