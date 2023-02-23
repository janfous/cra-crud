<?php declare(strict_types=1);

namespace App\model\service\Product;

use App\model\entity\Product\Product;
use DateTime;
use Nette\Http\Session;

class ProductService
{

    private Session $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
        $this->session->start();
    }

    /**
     * @return void
     *
     * create mock data in session in place of a database
     */
    public function initMockData(): void
    {
        if (!$this->session->hasSection('data')) {
            $section = $this->session->getSection('data');
            $section->set('1', new Product(1, 'apple', 10, new DateTime('now')));
            $section->set('2', new Product(2, 'orange', 15, new DateTime('yesterday')));
            $section->set('3', new Product(3, 'banana', 13, new DateTime('tomorrow')));
            $section->set('4', new Product(4, 'cucumber', 5, new DateTime('now - 7 days')));
        }
    }

    public function newEmpty(): Product
    {
        $product = new Product();
        $section = $this->session->getSection('data');
        $emptyId = 1;
        foreach ($section as $idx => $item) {
            $emptyId = $idx + 1;
        }

        $product->setId($emptyId);
        $product->setDateCreated(new DateTime('now'));

        return $product;
    }

    public function save(Product $product): void
    {
        $section = $this->session->getSection('data');

        $section->set((string)$product->getId(), $product);
    }

    public function delete(int $id): void
    {
        $this->session->getSection('data')->remove($id);
    }

}
