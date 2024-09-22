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
        Log::info('GetLinksJob started');
        try {
            $url = getSettings()->scrapingSite->newly_url;
            $client = new \Goutte\Client();
            $mainPost = $client->request('GET', $url);
            $pageUrls = [];

            // Collect the URLs from the post selector
            $mainPost->filter(getSettings()->scrapingSite->post_selector)->each(function ($node) use (&$pageUrls) {
                $pageUrls[] = $node->attr("href");
            });
            
            // Log the array of URLs as JSON
            Log::info('Collected URLs: ' . json_encode($pageUrls));

            $jobName = '\\App\\Jobs\\' . ucfirst(getSettings()->scrapingSite->site_name) . 'Job';

            // Dispatch a job for each URL
            foreach ($pageUrls as $pageUrl) {
                $jobName::dispatch($pageUrl);
                Log::info('Dispatched job for URL: ' . $pageUrl);
            }

            Log::info('GetLinksJob ended');
        } catch (\Exception $e) {
            Log::error('Error in GetLinksJob: ' . $e->getMessage() . "\n" . $e->getTraceAsString());
        }
    }
}
