<?php

namespace App\Jobs;

use App\Models\ArticleImage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use phpDocumentor\Reflection\Types\This;

class GoogleVisionRemovFaces implements ShouldQueue
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
        if(!$i){return;}

        $srcpath = storage_path('/app/' . $i->file);
        $image = file_get_contents($srcpath);

        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path('google_credential.json'));

        $imageAnnotator = new ImageAnnotatorClient();
        $response = $imageAnnotator->FaceDetection($image);
        $face = $response->getFaceAnnotations();

        foreach ($faces as $face){
            $vertice = $face->getBoudingPoly()->getVertices();

            echo "face\n";
            foreach ($vertices as $vertex){
                echo $vertex->getX() ." , " . $vertex->getY() . "\n";
            }
        }
    }
}
