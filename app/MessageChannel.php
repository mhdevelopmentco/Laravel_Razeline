<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MessageChannel extends Model
{
    protected $fillable = [
        'creator_id', 'fan_id', 'last_message_creator', 'last_mc_date',
        'last_message_fan', 'last_mf_date', 'unreads'
    ];

    protected $appends = [
        'creator_name', 'creator_photo', 'fan_name', 'fan_photo',
        'opponent_name', 'opponent_photo', 'opponent_id',
        'need_pay', 'op_last_image', 'op_last_date', 'unread_count',
        'has_active_messages'
    ];

    public $timestamps = true;

    public $table = 'message_channels';


    public function getHasActiveMessagesAttribute(){
        $messages = Message::where('channel_id', $this->id)
            ->whereNotIn('status', [Message::MESSAGE_STATUS_PENDING, Message::MESSAGE_STATUS_CANCELED])
            ->get();
        $message_count = count($messages);
        if($message_count >0)
        {
            return true;
        } else {
            return false;
        }
    }

    public function getCreatorNameAttribute()
    {
        $creator = User::find($this->creator_id);
        return $creator->name;
    }

    public function getCreatorPhotoAttribute()
    {
        $creator = User::find($this->creator_id);
        return $creator->photo;
    }

    public function getFanNameAttribute()
    {
        $fan = User::find($this->fan_id);
        return $fan->name;
    }

    public function getFanPhotoAttribute()
    {
        $fan = User::find($this->fan_id);
        return $fan->photo;
    }

    public function getOpponentNameAttribute()
    {
        $me = Auth::user();
        $mi = $me->id;

        return $this->creator_id == $mi ? $this->fan_name : $this->creator_name;
    }

    public function getOpponentIdAttribute()
    {
        $me = Auth::user();
        $mi = $me->id;

        if ($me->type == 'fan') {
            return $this->creator_id;
        } else {
            if ($mi != $this->fan_id) {
                return $this->fan_id;
            } else {
                return $this->creator_id;
            }
        }
    }

    public function getOpponentPhotoAttribute()
    {
        $me = Auth::user();
        $mi = $me->id;

        return $this->creator_id == $mi ? $this->fan_photo : $this->creator_photo;
    }

    public function getNeedPayAttribute()
    {
        $me = Auth::user();
        $mi = $me->id;

        //creator -> creator
        if ($me->type == User::USER_TYPE_CREATOR && $this->creator_id == $mi) {
            return false;
        }

        return true;
    }

    public function getOpLastmessageAttribute()
    {
        $me = Auth::user();
        $mi = $me->id;
        if ($me->type == User::USER_TYPE_CREATOR && $this->creator_id == $mi) {
            return $this->last_message_fan;
        } else {
            return $this->last_message_creator;
        }
    }

    public function getOpLastDateAttribute()
    {
        $me = Auth::user();
        $mi = $me->id;
        if ($me->type == User::USER_TYPE_CREATOR && $this->creator_id == $mi) {
            $mf_date = date('Y-m-d', strtotime($this->last_mf_date));
            $today = date('Y-m-d', strtotime('today'));

            if ($mf_date == $today) {
                return "Today";
            } else {
                return $this->last_mf_date;
            }
        } else {
            $mc_date = date('Y-m-d', strtotime($this->last_mc_date));
            $today = date('Y-m-d', strtotime('today'));

            if ($mc_date == $today) {
                return "Today";
            } else {
                return $this->last_mc_date;
            }
        }
    }

    public function getUnreadCountAttribute()
    {
        $me = Auth::user();
        $mi = $me->id;

        $messages = Message::where('channel_id', $this->id)
            ->where('sender_id', '<>', $mi)
            ->where('read', '<>', true)
            ->whereNotIn('status', [Message::MESSAGE_STATUS_PENDING, Message::MESSAGE_STATUS_CANCELED])
            ->get();

        $count = $messages ? $messages->count() : 0;
        return $count;
    }

}
