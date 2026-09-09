<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductController extends Controller {
    private $products;

    public function __construct()
    {
        parent::__construct();
        $this->products = $this->call->model('ProductModel', 'product_model');
    }

    public function index()
    {
        $products = $this->products->allProducts();
        $message = $_SESSION['product_message'] ?? null;
        unset($_SESSION['product_message']);
        $this->call->view('products/index', compact('products', 'message'));
    }

    public function create()
    {
        $this->call->view('products/form', [
            'product' => null,
            'formAction' => site_url('/products'),
            'heading' => 'Add product'
        ]);
    }

    public function store()
    {
        $this->saveProduct(null);
    }

    public function edit($id)
    {
        $product = $this->products->findProduct($id);
        if (!$product) {
            $this->setMessage('Product not found.');
            redirect('/products');
            return;
        }

        $this->call->view('products/form', [
            'product' => $product,
            'formAction' => site_url('/products/edit/' . (int) $id),
            'heading' => 'Edit product'
        ]);
    }

    public function update($id)
    {
        $this->saveProduct($id);
    }

    public function delete($id)
    {
        $this->products->deleteProduct($id);
        $this->setMessage('Product deleted successfully.');
        redirect('/products');
    }

    private function saveProduct($id)
    {
        $name = trim($_POST['product_name'] ?? '');
        $price = $_POST['price'] ?? '';
        $quantity = $_POST['quantity'] ?? '';

        if ($name === '' || !is_numeric($price) || (float) $price < 0 ||
            filter_var($quantity, FILTER_VALIDATE_INT) === false || (int) $quantity < 0) {
            $this->setMessage('Enter valid product details.');
            redirect('/products');
            return;
        }

        $data = [
            'product_name' => $name,
            'description' => trim($_POST['description'] ?? ''),
            'price' => number_format((float) $price, 2, '.', ''),
            'quantity' => (int) $quantity
        ];

        if ($id === null) {
            $this->products->createProduct($data);
            $this->setMessage('Product added successfully.');
        } else {
            $this->products->updateProduct($id, $data);
            $this->setMessage('Product updated successfully.');
        }
        redirect('/products');
    }

    private function setMessage($message)
    {
        $_SESSION['product_message'] = $message;
    }
}