<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = "customer";
    protected $fillable = [
        'id',
        'social_reason',
        'name_customer',
        'cnpj',
        'telephone',
        'email',
        'birth_date',
    ];
    public $timestamps = false;

    public  function storeCustomer(array $data)
    {
        $stmt = $this->create($data);
        if ($stmt) {
            return $stmt;
        }
        return false;
    }

    public function getAlCustomerl()
    {
        return $this->select('id', 'name_reason','social_reason', 'cnpj', 'email','birth_date')->paginate(5);
    }
    public function removeCostumer(int $id)
    {
        return $this->find($id)->delete();
    }

    public function getCostumer(int $id)
    {
        return $this->find($id);
    }

    public function updateCostumer(int $id, array $data)
    {
        return $this->find($id)->update($data);
    }
}
