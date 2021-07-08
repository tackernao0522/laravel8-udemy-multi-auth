<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('brand_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('subCategory_id')->unsigned();
            $table->bigInteger('subSubCategory_id')->unsigned();
            $table->string('product_name_ja');
            $table->string('product_name_en');
            $table->string('product_slug_ja');
            $table->string('product_slug_en');
            $table->string('product_code');
            $table->string('product_qty');
            $table->string('product_tags_ja');
            $table->string('product_tags_en');
            $table->string('product_size_ja')->nullable();
            $table->string('product_size_en')->nullable();
            $table->string('product_color_ja');
            $table->string('product_color_en');
            $table->string('selling_price');
            $table->string('discount_price')->nullable();
            $table->string('short_descp_ja');
            $table->string('short_descp_en');
            $table->string('long_descp_ja');
            $table->string('long_descp_en');
            $table->string('product_thambnail');
            $table->bigInteger('hot_deals')->nullable()->unsigned();
            $table->bigInteger('featured')->nullable()->unsigned();
            $table->bigInteger('spacial_offer')->nullable()->unsigned();
            $table->bigInteger('special_deals')->nullable()->unsigned();
            $table->bigInteger('status')->unsigned()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
