<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Message extends Model
{
    protected $fillable = [
        'channel_id', 'sender_id', 'type', 'message', 'read', 'payment_id', 'status', 'rate'
        ];

    protected $appends = [
        'sender_name', 'sender_photo', 'mine'
    ];

    public $timestamps = true;


    public $table = 'messages';

    const MESSAGE_STATUS_APPROVED = 'approved';
    const MESSAGE_STATUS_PENDING = 'pending';
    const MESSAGE_STATUS_CANCELED = 'canceled';

    //for fan
    const MESSAGE_STATUS_RESPONDED = 'responded';

    public function getSenderNameAttribute() {
        $sender = User::find($this->sender_id);
        return $sender->name;
    }

    public function getSenderPhotoAttribute() {
        $sender = User::find($this->sender_id);
        return $sender->photo;
    }


    public function getMineAttribute() {
        $user = Auth::user();
        return $user->id == $this->sender_id;
    }
}
