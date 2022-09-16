<?php

namespace App\Http\Controllers\RoomTyping;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoomTyping\RequestRoomTyping;
use App\Models\RoomTyping\RoomTyping;
use Illuminate\Http\Request;

class RoomTypingController extends Controller
{
    private $roomTyping;

    public function __construct(RoomTyping $roomTyping)
    {
        $this->roomTyping = $roomTyping;
    }

    public function store(RequestRoomTyping $requestRoomTyping){
        $insertRoomTyping = $this->roomTyping->storeRoomTyping($requestRoomTyping->all());
        if($insertRoomTyping){
            return Helper::returnApi("Room Typing created",201,$insertRoomTyping);
        }
        return Helper::returnApi("Internal Error",500);
    }
}
