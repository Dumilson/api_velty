<?php

namespace App\Http\Controllers\Customer;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Costumer\RequestStoreCostumer;
use App\Models\Address\Address;
use App\Models\Address\AddressRelationship;
use App\Models\Customer\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\Help;

class CustomerController extends Controller
{
    private $costumer;
    private $address;
    private $addressRelatioship;
    public function __construct(Customer $costumer, Address $address, AddressRelationship $addressRelationship)
    {
        $this->costumer = $costumer;
        $this->address = $address;
        $this->addressRelatioship = $addressRelationship;
    }

    public function store(RequestStoreCostumer $requestStoreCostumer){

            $cep_api = Helper::getCep($requestStoreCostumer->cep);
            if(is_array($cep_api)){
                try{
                    DB::beginTransaction();

                    $insertAddress = $this->address->storeAddress([
                        'cep' => $cep_api["cep"],
                        'public_place' => $cep_api["logradouro"],
                        'complement' => $cep_api["complemento"],
                        'city' => $cep_api["localidade"],
                        'uf' => $cep_api["uf"],
                        'number' => $requestStoreCostumer->number,
                    ]);

                    $insertCustomer = $this->costumer->storeCustomer($requestStoreCostumer->except('number'));
                    
                    $this->addressRelatioship->storeAddressRelationship([
                        'id_address' => $insertAddress->id,
                        'id_customer' => $insertCustomer->id,
                    ]);

                    DB::commit();

                    return Helper::returnApi("Customer created",201, [
                        'customer' => $insertCustomer,
                        'address' => $insertAddress
                    ]);
                }catch(\Exception $e){
                     DB::rollBack();
                     return Helper::returnApi("Internal Error",500,$e->getMessage());
                }
                
            }
            return Helper::returnApi("Internal Error CEP",500,$cep_api);
          
    }
}
