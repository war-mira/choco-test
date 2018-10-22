<?php

namespace App\Console\Commands;

use App\Models\Library\Illness;
use App\Models\Library\IllnessesGroupArticle;
use Illuminate\Console\Command;

class changeIllnessTypeToNewEditor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'longridjs:migrate';

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
        $illnesses = Illness::get();
        foreach ($illnesses as $illness){
            if(is_null($illness->content)){
                $illness->content = '{"rows":[{"id":1,"columns":[{"id":1,"empty":false,"items":[{"id":1,"type":"text","content":'.json_encode($illness->description).'}],"width":6}],"maxWidth":6,"emptyWidth":0,"itemsWidth":6}],"options":{"columns":6,"defaultItem":"text"},"container":"grid__container"}';
                $illness->save();
            }
        }
        $illnesses_articles = IllnessesGroupArticle::get();
        foreach ($illnesses_articles as $illness){
            if(is_null($illness->content)){
                $illness->content = '{"rows":[{"id":1,"columns":[{"id":1,"empty":false,"items":[{"id":1,"type":"text","content":'.json_encode($illness->description).'}],"width":6}],"maxWidth":6,"emptyWidth":0,"itemsWidth":6}],"options":{"columns":6,"defaultItem":"text"},"container":"grid__container"}';
                $illness->save();
            }
        }
    }
}
