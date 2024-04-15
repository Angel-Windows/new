<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\Request;
use App\Models\Products;
use Google\Spreadsheet\DefaultServiceRequest;
use Google\Spreadsheet\ServiceRequestFactory;
use Google\Spreadsheet\SpreadsheetService;

putenv('GOOGLE_APPLICATION_CREDENTIALS=' . storage_path('secret2.json'));

class GoogleSheetController extends BaseController
{

    public function get()
    {
        $values = [];

        $items = Products::query()
        ->select(['id','name','price','imgs','slug'])
        ->where('in_stock',1)
        ->get();

        foreach ($items as $item){
                $values [] = [
                    'ID' => $item->id,
                    'Item title' => $item->name,
                    'Price' => $item->price,
                    'Image URL' => $item->imgs ?
                        url('uploads/products/md/'.unserialize($item->imgs)[0]) :
                        NULL,
                    'Final URL' => route('product',$item->slug),
                ];
        }

        dd($values);
    }

    public function generate()
    {
        $client = new \Google_Client();
        try {
            $client->useApplicationDefaultCredentials();
            $client->setApplicationName("Something to do with my representatives");
            $client->setScopes(['https://www.googleapis.com/auth/drive', 'https://spreadsheets.google.com/feeds']);
            if ($client->isAccessTokenExpired()) {
                $client->refreshTokenWithAssertion();
            }

            $accessToken = $client->fetchAccessTokenWithAssertion()["access_token"];
            ServiceRequestFactory::setInstance(
                new DefaultServiceRequest($accessToken)
            );

            $spreadsheet = (new SpreadsheetService())
                ->getSpreadsheetFeed()
                ->getByTitle('Feed');

            $worksheets = $spreadsheet->getWorksheetFeed()->getEntries();
            $worksheets = $worksheets[0];
            $listFeed = $worksheets->getListFeed();


            $entries = $listFeed->getEntries();

            $this->clearSheet($entries);

            $products = $this->getProducts();
            foreach ($products as $product) {
                $listFeed->insert($product);
            }


        } catch (\Exception $exception) {
            echo $exception->getMessage();
            echo $exception->getFile();
            echo $exception->getLine();
        }
    }

    private function getProducts()
    {
        $values = [];

        $items = Products::query()
            ->select(['id', 'name', 'price', 'imgs', 'slug','description'])
            ->where('in_stock', 1)
            ->get();

        foreach ($items as $item) {
            $values [] = [
                'id' => $item->id,
                'title' => htmlspecialchars($item->name),
                'description' => htmlspecialchars($item->description),
                'price' => $item->price.'.00 UAH',
                'condition' => 'new',
                'availability' => 'in stock',
                "imagelink" => $item->imgs ?
                    htmlspecialchars(url('uploads/products/md/' . unserialize($item->imgs)[0])) :
                    NULL,
                'link' => htmlspecialchars(route('product', $item->slug)),
                'brand' => 'myoptics'
            ];
        }

        return $values;
    }

    private function clearSheet($list)
    {
        for($i = 0; $i < count($list); $i++){
            $list[0]->delete();
        }
    }
}
