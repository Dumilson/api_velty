<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = "address";
    protected $fillable = [
        'id',
        'cep',
        'public_place',
        'complement',
        'city',
        'uf',
        'number',
        'url_maps',
    ];
    public $timestamps = false;

    public  function storeAddress(array $data)
    {
        $stmt = $this->create($data);
        if ($stmt) {
            return $stmt;
        }
        return false;
    }

    public function getAllAddress()
    {
        return $this->select(
            'id',
            'cep',
            'public_place',
            'complement',
            'city',
            'uf',
            'number',
            'url_maps'
        )
        ->paginate(5);
    }
    public function removeAddress(int $id)
    {
        return $this->find($id)->delete();
    }

    public function getAddress(int $id)
    {
        return $this->find($id);
    }

    public function updateAddress(int $id, array $data)
    {
        return $this->find($id)->update($data);
    }

    public function verifyCep(string $cep){
        $cep = $this->where('cep',$cep)->first();
        if($cep){
            return $cep->id;
        }
        return false;
    }
}
