<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // modify this to your own needs
        SitemapGenerator::create(config('app.url'))
            ->hasCrawled(function (Url $url) {
                if (($url->segment(1) === 'storage') ||
                    ($url->segment(1) === 'liveInsert') ||
                    ($url->segment(1) === 'yesterdayInsert') ||
                    ($url->segment(1) === 'dataInsert') ||
                    ($url->segment(1) === 'stateInsert') ||
                    ($url->segment(1) === 'vaccineInsert') ||
                    ($url->segment(1) === 'dataGet') ||
                    ($url->segment(1) === 'test') ||
                    ($url->segment(1) === 'home') ||
                    ($url->segment(1) === 'login')
                    ($url->segment(1) === 'check')
                ) {
                    return;
                }
                return $url;
            })
            ->writeToFile(public_path('sitemap.xml'));
    }
}
