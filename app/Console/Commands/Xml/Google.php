<?php

namespace App\Console\Commands\Xml;

use App\Models\Category;
use App\Models\Charlist;
use App\Models\CharlistOptions;
use App\Models\Products;
use App\Models\ProductsCategories;
use DOMDocument;
use Illuminate\Console\Command;

class Google extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xml:google';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create XML for Google Tag';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $dom = new DOMDocument();
            $dom->encoding = 'utf-8';
            $dom->xmlVersion = '1.0';
            $dom->formatOutput = true;

            if (!file_exists(public_path('xml'))) {
                mkdir(public_path('xml'));
            }

            $xml_file_name = public_path('xml/google.xml');

            $root = $dom->createElement('rss');
            $root->setAttribute('xmlns:g', 'http://base.google.com/ns/1.0');
            $root->setAttribute('version', '2.0');
            $channel = $dom->createElement('channel');
            $channel->appendChild($dom->createElement('title', 'Myoptics интернет магазин контактных линз'));
            $channel->appendChild($dom->createElement('link', 'https://myoptics.com.ua/'));
            $channel->appendChild($dom->createElement('description', 'Интернет магазин контактных линз №1 в Украине Myoptics предлагает приобрести по лояльной цене средства коррекции зрения и аксессуары к ним. Работая не первый год на отечественном рынке, сегодня мы можем предложить всем нашим клиентам широкий ассортимент контактных линз, увлажняющих капель, растворов для ухода, контейнеров для перевозки, наборов в дорогу.'));

            Products::chunk(500, function ($products) use ($dom, $channel) {
                foreach ($products as $product) {
                    if (empty($product->slug)) continue;

                    $item_node = $this->getItemNode($dom, $product);
                    $channel->appendChild($item_node);
                }
            });

            $root->appendChild($channel);
            $dom->appendChild($root);
            $dom->save($xml_file_name);
        } catch (\Exception $exception) {

        }
    }

    private function getItemNode($dom, $product) {
        $item_node = $dom->createElement('item');

        $item_node->appendChild($dom->createElement('g:id', $product->id));
        $item_node->appendChild($dom->createElement('g:title', htmlspecialchars($product->name)));
        $item_node->appendChild($dom->createElement('g:description', $product->description));
        $item_node->appendChild($dom->createElement('g:link', route('product', ['page_url' => $product->slug])));

        $images = unserialize($product->imgs);
        if (!empty($images)) {
            foreach ($images as $k => $image) {
                if ($k == 0) {
                    $key = 'g:image_link';
                } else {
                    $key = 'g:additional_image_link';
                }

                $item_node->appendChild($dom->createElement($key, url('/uploads/products/lg/' . $image)));
            }
        }

        $item_node->appendChild($dom->createElement('g:condition', 'new'));

        $charlist_options = CharlistOptions::getOptions($product->id);
        if (isset($charlist_options['17'])) {
            if (in_array($charlist_options['17'][0], ['нет в наличии', 'ожидается'])) {
                $item_node->appendChild($dom->createElement('g:availability', 'out of stock'));
            } else {
                $item_node->appendChild($dom->createElement('g:availability', 'in stock'));
            }
        } else {
            $item_node->appendChild($dom->createElement('g:availability', 'in stock'));
        }

        if ($product->oldPrice > 0) {
            $item_node->appendChild($dom->createElement('g:price', $product->oldPrice . ' UAH'));
            $item_node->appendChild($dom->createElement('g:sale_price', $product->price . ' UAH'));
        } else {
            $item_node->appendChild($dom->createElement('g:price', $product->price . ' UAH'));
        }

        Category::clearRes();
        $cats = Category::get_parent_categories( ProductsCategories::where('product_id', '=', $product->id)->pluck('category_id'));
        if (!empty($cats)) {
            if (!empty($cats)) {
                $productTypes = array_column($cats, 'name');
                $item_node->appendChild($dom->createElement('g:product_type', implode(' > ', $productTypes)));

                // 2923 - Контактні лінзи
                // 3011 - Догляд за контактними лінзами
                // 2521 - Аксесуари для окулярів
                $googleCat = 0;
                if (!empty($cats[1]) && $cats[1]['id'] == '102') {
                    $googleCat = 2521;
                } else if ($cats[0]['id'] == 67) {
                    $googleCat = 2923;
                } else if ($cats[0]['id'] == 73) {
                    $googleCat = 3011;
                }

                if ($googleCat) {
                    $item_node->appendChild($dom->createElement('g:google_product_category', $googleCat));
                }
            }
        }

        $brand = '';

        $characts = unserialize($product->specification);
        if (!empty($characts)) {
            foreach ($characts as $char) {
                if (empty($char['name']) || empty($char['value'])) continue;
                $char['value'] = htmlspecialchars($char['value']);

                if ($char['name'] == 'Производитель') {
                    $brand = $char['value'];
                } else {
                    $product_detail = $dom->createElement('g:product_detail');
                    $product_detail->appendChild($dom->createElement('g:attribute_name', $char['name']));
                    $product_detail->appendChild($dom->createElement('g:attribute_value', $char['value']));
                    $item_node->appendChild($product_detail);
                }
            }
        }

        if (!empty($brand)) {
            $item_node->appendChild($dom->createElement('g:brand', $brand));
        }

        return $item_node;
    }
}
