<?php declare(strict_types=1);

namespace App\Presenters;

use App\components\form\Product\ProductForm;
use App\model\entity\Product\Product;
use App\model\facade\Product\ProductFacade;
use App\model\service\Product\ProductService;
use Latte\Runtime\Template;
use Nette\Application\UI\Presenter;
use Nette\DI\Attributes\Inject;

/**
 * * @property Template $template
 */
class ProductPresenter extends Presenter
{

    #[Inject]
    public Product $product;

    #[Inject]
    public ProductFacade $productFacade;

    #[Inject]
    public ProductService $productService;

    public function beforeRender()
    {
        $this->productService->initMockData();
    }

    public function actionDefault()
    {
        $this->template->items = $this->productFacade->findAll();
    }

    public function actionDetail(?int $id)
    {
        if (!$id) {
            $this->product = $this->productService->newEmpty();
        } else {
            $this->product = $this->productFacade->findById($id);
        }

    }

    public function handleDelete(int $id)
    {
        $this->productService->delete($id);

        $this->template->items = $this->productFacade->findAll();
        $this->redrawControl('productTable');
    }

    protected function createComponentProductForm(): ProductForm
    {
        return new ProductForm($this->product, $this->productService);
    }

}
