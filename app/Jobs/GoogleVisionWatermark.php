<?php

namespace App\Jobs;

use Spatie\Image\Image;
use App\Models\ArticleImage;
use Illuminate\Bus\Queueable;
use Spatie\Image\Manipulations;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

class GoogleVisionWatermark implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $article_image_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($article_image_id)
    {
        $this->article_image_id = $article_image_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $i = ArticleImage::find($this->article_image_id);
        if(!$i)
        {
            return;
        }

        $srcPath = storage_path('/app/' . $i->file);
        $image = file_get_contents($srcPath);

        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path('google_credential.json'));

        $imageAnnotator = new ImageAnnotatorClient();


            $image=Image::load($srcPath);
            $image->watermark(base_path('resources/img/watermark.png'))
            ->watermarkOpacity(50)
            ->watermarkPosition(Manipulations::POSITION_CENTER)
            ->watermarkHeight(10, Manipulations::UNIT_PERCENT)    
            ->watermarkWidth(10, Manipulations::UNIT_PERCENT); 
             
            $image->save($srcPath);
        
        $imageAnnotator->close();
    }
}
