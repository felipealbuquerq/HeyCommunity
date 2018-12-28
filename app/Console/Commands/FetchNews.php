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
    protected $signature = 'fetch:news
                             {--startPage=1 : Start on what page}
                             {--totalPage=1 : How many pages}
     ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'fetch news';

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
        $startPage = $this->option('startPage');
        $startPage--;
        $totalPage = $this->option('totalPage');

        foreach (range(1, $totalPage) as $num) {
            $startPage++;

            $api = env('FETCH_NEWS_API') . '&page=' . $startPage;
            echo $api;
            echo "\n";

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
}
