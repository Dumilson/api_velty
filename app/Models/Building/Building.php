<?php

namespace App\Models\Building;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;
    protected $table = "building";
    protected $fillable = [
        'id',
        'building_name',
        'descrption'
    ];
    public $timestamps = false;

    public  function storeBuilding(array $data)
    {
        $stmt = $this->create($data);
        if ($stmt) {
            return $stmt;
        }
        return false;
    }

    public function getAllBuilding()
    {
        return $this->select(
            'id',
            'building_name',
            'descrption',
        )
            ->paginate(5);
    }
    public function removeBuilding(int $id)
    {
        return $this->find($id)->delete();
    }

    public function getBuilding(int $id)
    {
        return $this->find($id);
    }

    public function updateBuilding(int $id, array $data)
    {
        return $this->find($id)->update($data);
    }
}
