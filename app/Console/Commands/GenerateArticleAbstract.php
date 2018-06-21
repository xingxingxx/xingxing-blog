<?php

namespace App\Console\Commands;

use App\Article;
use Illuminate\Console\Command;

class GenerateArticleAbstract extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'article:generateAbstract';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Articles abstract and cover';

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
        $articles = Article::where('abstract', '')
            ->orderBy('created_at', 'desc')
            ->get();
        foreach ($articles as $article) {
            $article->cover = get_cover($article->content);
            if($article->cover){
                $article->abstract = get_abstract($article->content);
            }else{
                $article->abstract = get_abstract($article->content,360);
            }
            $article->save();
            $this->info('id:' . $article->id . PHP_EOL
                . 'title:' . $article->title . PHP_EOL
                . 'cover:' . $article->cover . PHP_EOL
                . 'abstract:' . $article->abstract);

        }
        $this->info('handle complete!');
    }
}
