<?php declare(strict_types=1);

namespace app\Presenters;

use App\model\entity\Product\Product;
use App\model\facade\Product\ProductFacade;
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

    public function actionDefault()
    {
        $this->template;
    }

}