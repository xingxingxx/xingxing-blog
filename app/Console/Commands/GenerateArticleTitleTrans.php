<?php

namespace App\Console\Commands;

use App\Article;
use Illuminate\Console\Command;
use Overtrue\Pinyin\Pinyin;

class GenerateArticleTitleTrans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'article:generateTitleTrans';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Articles title trans';

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
        $articles = Article::whereTitleTrans('')
            ->orderBy('created_at', 'desc')
            ->get();
        foreach ($articles as $article) {
            $pinyin = (new Pinyin())->convert($article->title);
            $pinyin = implode('-', $pinyin);
            $article->title_trans = $pinyin;
            $article->save();
            $this->info('id:' . $article->id . PHP_EOL
                . 'title:' . $article->title . PHP_EOL
                . 'cover:' . $article->title_trans);

        }
        $this->info('handle complete!');
    }
}
