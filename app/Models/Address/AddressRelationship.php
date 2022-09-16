<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressRelationship extends Model
{
    use HasFactory;
    protected $table = "address_relationship";
    protected $fillable = [
        'id',
        'id_address',
        'id_customer',
        'id_building',
    ];
    public $timestamps = false;

    public  function storeAddressRelationship(array $data)
    {
        $stmt = $this->create($data);
        if ($stmt) {
            return $stmt;
        }
        return false;
    }

    public function getAllAddressRelationship()
    {
        return $this->select(
            'id',
            'id_address',
            'id_customer',
            'id_building',
        )
        ->paginate(5);
    }
    public function removeAddressRelationship(int $id)
    {
        return $this->find($id)->delete();
    }

    public function getAddressRelationship(int $id)
    {
        return $this->find($id);
    }

    public function updateAddressRelationship(int $id, array $data)
    {
        return $this->find($id)->update($data);
    }
}
