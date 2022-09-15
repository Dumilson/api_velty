<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Costumer\RequestStoreCostumer;
use App\Models\Customer\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $costumer;
    public function __construct(Customer $costumer)
    {
        $this->costumer = $costumer;
    }

    public function store(RequestStoreCostumer $requestStoreCostumer){
        dd($requestStoreCostumer->all());
    }
}
