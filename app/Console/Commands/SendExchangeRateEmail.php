<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class SendExchangeRateEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send-exchange-rate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send USD to RUB exchange rate via email';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $apiUrl = 'https://api.exchangerate-api.com/v4/latest/USD';
        $response = Http::get($apiUrl);

        if ($response->successful() && isset($response['rates']['RUB'])) {
            $rate = $response['rates']['RUB'];
            $message = "The current exchange rate of USD to RUB is: 1 USD = $rate RUB.";
        } else {
            $message = 'Unable to fetch the exchange rate at this time.';
        }

        Mail::raw($message, function ($mail) {
            $mail->to('fatbike08@gmail.com') // Replace with your email
                 ->subject('Current USD to RUB Exchange Rate');
        });

        $this->info('Exchange rate email sent successfully.');

        return 0;
    }
}
