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
            $table->integer('category_id');
            $table->integer('subcategory_id')->nullable();
            $table->string('product_name');
            $table->integer('product_price');
            $table->integer('product_discount')->nullable();
            $table->integer('discount_price');
            $table->text('short_desp');
            $table->longText('long_desp');
            $table->string('product_preview')->nullable();
            $table->tinyInteger('status')->default('0');
            $table->string('review')->nullable();
            $table->integer('star')->nullable();
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->integer('created_by');
            $table->softDeletes();
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
