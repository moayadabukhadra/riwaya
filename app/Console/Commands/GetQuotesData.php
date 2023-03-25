<?php

namespace App\Console\Commands;

use App\Models\Author;
use App\Models\Quote;
use Goutte\Client;
use Illuminate\Console\Command;

class GetQuotesData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-quotes-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $number_of_pages = 54;
        $client = new Client();


        for ($i = 1; $i < $number_of_pages; $i++) {

                $link = 'https://foulabook.com/ar/quotes?page=' . $i;
                $crawler = $client->request('GET', $link);
                $quotes = $crawler->filter('.pi-testimonial')->each(function ($node) {
                    $quote['body'] = $node->filter('.pi-testimonial-content')->text();
                    $quote['author'] = $node->filter('.pi-testimonial-author')->filter('a')->filter('strong')->text();
                    $author = Author::where('name', $quote['author'])->first();
                    if ($author) {
                        Quote::create([
                            'body' => $quote['body'],
                            'author_id' => $author->id,
                        ]);
                    }
                });


        }
    }
}
