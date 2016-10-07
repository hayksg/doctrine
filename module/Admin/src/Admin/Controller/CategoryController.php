<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Model\CategoryTable;

class CategoryController extends AbstractActionController
{
    private $categoryTable;

    public function __construct(CategoryTable $categoryTable)
    {
        $this->categoryTable = $categoryTable;
    }

    public function indexAction()
    {
        $categories = $this->categoryTable->getAllCategories();

        $viewModel = new ViewModel([
            'categories' => $categories,
        ]);
        return $viewModel;
    }

    public function addAction()
    {

    }

    public function editAction()
    {

    }

    public function deleteAction()
    {

    }
}
