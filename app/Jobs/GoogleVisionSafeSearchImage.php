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


class GoogleVisionSafeSearchImage implements ShouldQueue
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

        putenv('GOOGLE_APPLICATION_CREDENTIALS =' . base_path('google_credentials.json'));

        $imageAnnotator = new ImageAnnotatorClient();
        $response = $imageAnnotator->safeSearchDetection($image);
        $imageAnnotator->close();

        $safe = $response->getSafeSearchDetection();

        $adult = $safe->getAdult();
        $medical = $safe->getMedical();
        $spoof = $safe->getSpoof();
        $violence = $safe->getViolence();
        $racy = $safe->getRacy();

        //echo json_encode([$adult, $medical, $spoof, $violence, $racy]);

        $likelihoodName = [
            'UNKNOWN', 'VERY_UNLIKELY', 'UNLIKELY', 'POSSIBLE', 'LIKELY', 'VERY_LIKELY'
        ];

        $i->adult = $likelihoodName[$adult];
        $i->medical = $likelihoodName[$medical];
        $i->spoof = $likelihoodName[$spoof];
        $i->violence = $likelihoodName[$violence];
        $i->racy = $likelihoodName[$racy];

        $i->save();
    }
}
