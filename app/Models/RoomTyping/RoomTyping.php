<?php

namespace App\Models\RoomTyping;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomTyping extends Model
{
    use HasFactory;
    protected $table = "room_typing";
    protected $fillable = [
        'id',
        'name_typing',
        'description',
    ];
    public $timestamps = false;

    public  function storeRoomTyping(array $data)
    {
        $stmt = $this->create($data);
        if ($stmt) {
            return $stmt;
        }
        return false;
    }

    public function getAllRoomTyping()
    {
        return $this->select(
            'id',
            'name_typing',
            'description',
        )
            ->paginate(5);
    }
    public function removeRoomTyping(int $id)
    {
        return $this->find($id)->delete();
    }

    public function getRoomTyping(int $id)
    {
        return $this->find($id);
    }

    public function updateRoomTyping(int $id, array $data)
    {
        return $this->find($id)->update($data);
    }
}
