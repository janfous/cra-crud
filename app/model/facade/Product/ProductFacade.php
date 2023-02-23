<?php declare(strict_types=1);

namespace App\model\facade\Product;

use App\model\service\Product\ProductService;
use Nette\Http\Session;

class ProductFacade
{
    private ProductService $productService;
    private Session $session;

    public function __construct(
        ProductService $productService,
        Session $session
    )
    {
        $this->productService = $productService;
        $this->session = $session;
    }

    public function findById(int $id)
    {
        return $this->session->getSection('data')->get((string)$id);
    }

    public function findAll()
    {
        if ($this->session->hasSection('data')) {
            $this->productService->initMockData();
        }

        return $this->session->getSection('data');
    }

}
