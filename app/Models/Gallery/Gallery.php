<?php

namespace App\Models\Gallery;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $table = "gallery";
    protected $fillable = [
        'id',
        'filename',
        'type_gallery',
        'id_creator',
    ];
    public $timestamps = false;

    public  function storeGallery(array $data)
    {
        $stmt = $this->create($data);
        if ($stmt) {
            return $stmt;
        }
        return false;
    }

    public function getAllGallery()
    {
        return $this->select(
            'id',
            'filename',
            'type_gallery',
            'id_creator',
        )
            ->paginate(5);
    }
    public function removeGallery(int $id)
    {
        return $this->find($id)->delete();
    }

    public function getGallery(int $id)
    {
        return $this->find($id);
    }

    public function updateGallery(int $id, array $data)
    {
        return $this->find($id)->update($data);
    }
}
