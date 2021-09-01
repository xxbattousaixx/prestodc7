<?php

namespace App\Jobs;

use App\Models\ArticleImage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Google\Cloud\Core\ServiceBuilder;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;


class GoogleVisionLabelImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $article_image_id;

    public function __construct($article_image_id)
    {
        $this->article_image_id = $article_image_id;
    }


    public function handle()
    {
        $i = ArticleImage::find($this->article_image_id);

        if (!$i) {
            return;
        }

        $image = file_get_contents(storage_path('/app/' . $i->file));

        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path('google_credential.json'));

        $imageAnnotator = new ImageAnnotatorClient();
        $response = $imageAnnotator->labelDetection($image);
        $labels = $response->getLabelAnnotations();


        if ($labels) {

            $result = [];
            foreach ($labels as $label) {
                $result[] = $label->getDescription();
            }
            $i->labels = $result;
            $i->save();
        }

        $imageAnnotator->close();
    }
}
