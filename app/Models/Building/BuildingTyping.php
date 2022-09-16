<?php

namespace App\Models\Building;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildingTyping extends Model
{
    use HasFactory;
    protected $table = "building_typing";
    protected $fillable = [
        'id',
        'id_building',
        'id_typing',
        'value_for_minute',
    ];
    public $timestamps = false;

    public  function storeBuildingTyping(array $data)
    {
        $stmt = $this->create($data);
        if ($stmt) {
            return $stmt;
        }
        return false;
    }

    public function getAllBuildingTyping()
    {
        return $this->select(
            'id',
            'id_building',
            'id_typing',
            'value_for_minute',
        )
            ->paginate(5);
    }
    public function removeBuildingTyping(int $id)
    {
        return $this->find($id)->delete();
    }

    public function getBuildingTyping(int $id)
    {
        return $this->find($id);
    }

    public function updateBuildingTyping(int $id, array $data)
    {
        return $this->find($id)->update($data);
    }
}
