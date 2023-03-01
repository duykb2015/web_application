<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\CategoryModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['Common', 'form', 'url'];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }

    public $cartTotal = 0;
    public function __construct()
    {
        $cartModel = new CartModel();
        $this->cartTotal = count($cartModel->where('customer_id', session()->get('user_id'))->findAll());
    }
    public function getSubCategory()
    {
        $categoryModel = new CategoryModel();

        $category = $categoryModel->where('parent_id = 0 AND status = 1')->findAll();
        $subCategory = $categoryModel->where('parent_id > 0 AND status = 1')->findAll();
        foreach ($category as $key => $item) {
            foreach ($subCategory as $row) {
                if ($row['parent_id'] == $item['id'])
                    $item['subCategory'][]  = $row;
            }
            $category[$key] = $item;
        }
        return $category;
    }
}
