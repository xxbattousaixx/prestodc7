<?php
use App\Models\Category;


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        $categories = ['Auto','Sport','Cucina','Spazio','Viaggi','Avventura','Tech','Giardino','Videogiochi','Animali'];

        foreach ($categories as $category) {
            Category::create(['name'=>$category]);
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
