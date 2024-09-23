<?php

namespace App\Jobs;

use Log;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GetLinksJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $url = getSettings()->scrapingSite->newly_url;
            $client = new \Goutte\Client();
            $mainPost = $client->request('GET', $url);
            $pageUrls = [];

            $mainPost->filter(getSettings()->scrapingSite->post_selector)->each(function ($node) use (&$pageUrls) {
                $pageUrls[] = $node->attr("href");
            });

            Log::info('Collected URLs: ' . json_encode($pageUrls));

            $jobName = '\\App\\Jobs\\' . ucfirst(getSettings()->scrapingSite->site_name) . 'Job';

            foreach ($pageUrls as $pageUrl) {
                $jobName::dispatch($pageUrl);
                Log::info('Dispatched job for URL: ' . $pageUrl);
            }


        } catch (\Exception $e) {
            Log::error('Error in GetLinksJob: ' . $e->getMessage() . "\n" . $e->getTraceAsString());
        }
    }
}
