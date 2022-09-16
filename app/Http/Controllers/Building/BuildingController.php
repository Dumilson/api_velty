<?php

namespace App\Http\Controllers\Building;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Building\RequestStoreBuilding;
use App\Models\Address\Address;
use App\Models\Building\Building;
use App\Models\Building\BuildingTyping;
use App\Models\Gallery\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuildingController extends Controller
{
    private $building;
    private $gallery;
    private $building_typing;
    private $address;
    public function __construct(Building $building, Gallery $gallery, BuildingTyping $building_typing, Address $address)
    {
        $this->building = $building;
        $this->gallery = $gallery;
        $this->building_typing = $building_typing;
        $this->address = $address;
    }

    public function store(RequestStoreBuilding $requestStoreBuilding)
    {
        $cep_api = Helper::getCep($requestStoreBuilding->cep);
        if (is_array($cep_api)) {
            try {
                DB::beginTransaction();

                $insertAddress = $this->address->storeAddress([
                    'cep' => $cep_api["cep"],
                    'public_place' => $cep_api["logradouro"],
                    'complement' => $cep_api["complemento"],
                    'city' => $cep_api["localidade"],
                    'uf' => $cep_api["uf"],
                    'number' => $requestStoreBuilding->number,
                ]);

                $insertBuilding = $this->building
                    ->storeBuilding($requestStoreBuilding->except('number', 'images'));

                if ($requestStoreBuilding->hasFile('images')) {
                    foreach ($requestStoreBuilding->images as $file) {
                        $upload = Helper::upload($file, '/storage/gallery/');
                        if ($upload["status"] == true) {
                            $this->gallery->storeGallery([
                                'filename' => $upload["message"],
                                'type_gallery' => 0, // 0 = building , 1 = room
                                'id_creator' => $insertBuilding->id,
                            ]);
                        }
                    }
                }

                $this->building_typing->storeBuildingTyping([
                    'id_building' => $insertBuilding->id,
                    'id_typing' => $requestStoreBuilding->id_typing,
                    'value_for_minute' => $requestStoreBuilding->value_for_minute,
                ]);

                DB::commit();

                return Helper::returnApi("Building created",201, [
                    'building' => $insertBuilding,
                    'address' => $insertAddress
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                return Helper::returnApi("Internal Error",500,$e->getMessage());
           }
           
       }
       return Helper::returnApi("Internal Error CEP",500,$cep_api);
    }
}
