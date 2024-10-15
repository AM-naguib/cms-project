<?php

namespace App\Console\Commands;

use App\Jobs\CinematyJob;
use Illuminate\Console\Command;
use Log;

class GetOldCinematy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'old:cinematy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $url = "https://cinematyko.online/newly/page/";
        $client = new \Goutte\Client();
        for ($i = 2; $i < 1000; $i++) {
            $page = $url . $i;
            $mainPost = $client->request('GET', $page);

            $mainPost->filter(getSettings()->scrapingSite->post_selector)->each(function ($node) use (&$pageUrls) {
                CinematyJob::dispatch($node->attr("href"));
            });
        }

    }
}
