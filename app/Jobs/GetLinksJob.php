<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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
            $url = "https://eg.tuktuksu.cfd/recent/";
            $client = new \Goutte\Client();
            $mainPost = $client->request('GET', $url);
            $pageUrls = [];

            $mainPost->filter("body > div.Content--Wrapper > section > div.MasterLoadMore.allBlocks > ul > div > a")->each(function ($node) use (&$pageUrls) {
                $pageUrls[] = $node->attr("href");
            });
            
            foreach ($pageUrls as $pageUrl) {
                ScrapTuktuk::dispatch($pageUrl);
            }
        } catch (\Exception $e) {
            \Log::error('Error in GetLinksJob: ' . $e->getMessage());
        }
    }
}