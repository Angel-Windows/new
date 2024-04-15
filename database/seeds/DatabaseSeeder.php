<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

//         $this->call('ExampleNews');
//         $this->call(PageSeederTranslation::class);
//         $this->call(SliderSeederTranslation::class);
//         $this->call(BrandsSeederTranslation::class);
//        $this->call(DeliverySeederTranslation::class);
//        $this->call(PaymentSeederTranslation::class);
//        $this->call(FeaturesSeederTranslation::class);
//        $this->call(OptiobVariantsSeederTranslation::class);
//        $this->call(CharListSeederTranslation::class);
        $this->call(CharLisOptionVariantstSeederTranslation::class);
//        $this->call(CategorySeederTranslation::class);
//        $this->call(ProductCopySeeder::class);
//        $this->call(ProductsSeederTranslation::class);
//        $this->call(SettingsSeeder::class);

        Model::reguard();
    }
}
