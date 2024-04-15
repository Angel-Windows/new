<?php

use Illuminate\Database\Seeder;

class ProductCopySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $oldProducts = \App\Models\ProductsOld::all();

        foreach ($oldProducts as $oldProduct) {

            \App\Models\Products::create([
                'id' => $oldProduct->id,
                'rating_sum' => $oldProduct->rating_sum,
                'votes' => $oldProduct->votes,
                'slug' => $oldProduct->slug,
                'name' => $oldProduct->name,
                'code' => $oldProduct->code,
                'description' => $oldProduct->description,
                'body' => $oldProduct->body,
                'specification' => $oldProduct->specification,
                'price' => $oldProduct->price,
                'oldPrice' => $oldProduct->oldPrice,
                'in_stock' => $oldProduct->in_stock,
                'main_img' => $oldProduct->main_img,
                'imgs' => $oldProduct->imgs,
                'alike' => $oldProduct->alike,
                'sale' => $oldProduct->sale,
                'discount' => $oldProduct->discount,
                'new' => $oldProduct->new,
                'meta_title' => $oldProduct->meta_title,
                'meta_keywords' => $oldProduct->meta_keywords,
                'meta_description' => $oldProduct->meta_description,
            ]);
        }

    }
}
