<?php

namespace App\components\form\Product;

use App\model\entity\Product\Product;
use App\model\service\Product\ProductService;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;
use Nette\Application\UI\Template;

/** @property Template $template */
final class ProductForm extends Control
{

    private Product $product;

    private ProductService $productService;

    public function __construct(
        Product $product,
        ProductService $productService
    )
    {
        $this->product = $product;
        $this->productService = $productService;
    }

    public function render(): void
    {
        $this->template->setFile(__DIR__ . '\productForm.latte');
        $this->template->render();
    }

    public function createComponentForm(): Form
    {
        $form = new Form;

        $form->onSubmit[] = function (Form $values) {
            $this->product->setName($values->getValues()->name);
            $this->product->setPrice($values->getValues()->price);

            $this->productService->save($this->product);
            $this->getPresenter()->redirect('default');
        };

        $form->addText('id', 'id')
            ->setDisabled()
            ->setDefaultValue($this->product->getId());

        $form->addText('name', 'name')
            ->setDefaultValue($this->product->getName())
            ->setRequired();

        $form->addInteger('price', 'price')
            ->setDefaultValue($this->product->getPrice())
            ->addRule($form::MIN, 'Price must be higher than %d', 1)
            ->setRequired();

        $form->addText('dateCreated', 'date created')
            ->setDisabled()
            ->setDefaultValue($this->product->getDateCreated()->format('Y-m-d'));

        $form->addSubmit('submit', 'submit');

        return $form;
    }

}
