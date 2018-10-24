<?php

namespace App\Console\Commands;

use App\News;
use Illuminate\Console\Command;

class FetchNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $api = env('FETCH_NEWS_API');
        $headers = ['Authorization' => 'APPCODE ' . env('FETCH_NEWS_APPCODE', 'null')];

        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('GET', $api, [
                'headers'   =>  $headers,
            ]);
        } catch (\GuzzleHttp\Exception\RequestException $exception) {
            echo $exception;
            report($exception);
            return false;
        }

        if ($response->getStatusCode() == 200) {
            $content = $response->getBody()->getContents();
            $data = json_decode($content)->showapi_res_body->pagebean->contentlist;

            foreach ($data as $index => $news) {
                $newsData = [
                    'origin'        =>  $news->source,
                    'category'      =>  $news->channelName,
                    'title'         =>  $news->title,
                    'content'       =>  $news->html,
                    'avatar'        =>  $news->havePic ? $news->imageurls[0]->url : '',
                    'gallery'       =>  json_encode($news->imageurls),
                    'url'           =>  $news->link,
                    'weburl'        =>  $news->link,
                    'time'          =>  $news->pubDate,
                ];

                News::updateOrCreate($newsData);
            }
        }
    }
}
