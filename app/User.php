<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\MessageChannel;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'type', 'birthday', 'gender', 'education', 'profession', 'description', 'photo', 'do_not_send', 'rate', 'status',
        'subscription_end_at', 'username', 'background'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
        'unread_messages', 'subscription_available', 'me',
        'received_amount', 'sent_amount', 'responded_amount',
        'balance_amount'
    ];

    const USER_TYPE_CREATOR = 'creator';
    const USER_TYPE_FAN = 'fan';

    const USER_STATUS_PENDING = 0; //default
    const USER_STATUS_ACTIVATED = 1;
    const USER_STATUS_BLOCKED = 2;

    public function getPhotoAttribute($value) {
        if($value == null) {
            return asset('image/avatar_placeholder.jpg');
        } else {
            return asset($value);
        }
    }

    public function getBackgroundAttribute($value) {
        if($value == null) {
            return asset('image/profile-background.jpg');
        } else {
            return asset($value);
        }
    }

    public function getUnreadMessagesAttribute() {
        $mi = $this->id;
        $channel_ids = MessageChannel::where('creator_id', $mi)
            ->orWhere('fan_id', $mi)
            ->get()
            ->pluck('id');
        $messages = Message::whereIn('channel_id', $channel_ids)
            ->where('sender_id', '<>', $mi)
            ->where('read', '<>', true)
            ->whereNotIn('status', [Message::MESSAGE_STATUS_PENDING, Message::MESSAGE_STATUS_CANCELED])
            ->get();

        $count =$messages ? $messages->count() : 0;


        return $count == 0 ? null : $count;

    }

    public function getSubscriptionAvailableAttribute() {
        return false;
        //return $this->subscription_end_at && Carbon::now()->lt(Carbon::parse($this->subscription_end_at));
    }

    public function getMeAttribute() {
        if(Auth::user()) {
            $mi = Auth::user()->id;
            return $mi == $this->id;
        } else {
            return false;
        }


    }

    public function getReceivedAmountAttribute() {
        if(Auth::user()){
            $user = Auth::user();
            $mi = $user->id;

            $amount = 0;
            $channel_ids = MessageChannel::where('creator_id', $mi)->get()->pluck('id');
            $messages = Message::whereIn('channel_id', $channel_ids)
                ->where('sender_id', '<>', $mi)
                ->get();

            foreach($messages as $m) {
                $amount += $user->rate;
            }

            return $amount;
        }

        return 0;
    }

    public function getRespondedAmountAttribute() {

        if(Auth::user()){
            $user = Auth::user();
            $mi = $user->id;

            $amount = 0;
            $channel_ids = MessageChannel::where('creator_id', $mi)->get()->pluck('id');
            $messages = Message::whereIn('channel_id', $channel_ids)
                ->where('sender_id', '<>', $mi)
                ->where('status', Message::MESSAGE_STATUS_RESPONDED)
                ->get();

            foreach($messages as $m) {
                $amount += $user->rate;
            }

            return $amount;
        }
        return 0;
    }

    public function getSentAmountAttribute() {
        if(Auth::user()){
            $user = Auth::user();
            $mi = $user->id;

            $amount = 0;
            $channel_ids = MessageChannel::where('fan_id', $mi)->get()->pluck('id');
            $messages = Message::whereIn('channel_id', $channel_ids)
                ->where('sender_id', $mi)
                ->where(function($query) {
                    $query->where('status', Message::MESSAGE_STATUS_RESPONDED)
                        ->where('status', Message::MESSAGE_STATUS_APPROVED);
                })
                ->get();

            foreach($messages as $m) {
                $amount += $user->rate;
            }

            return $amount;
        }

        return 0;
    }

    public function getBalanceAmountAttribute() {
        if(Auth::user()){
            $user = Auth::user();
            $mi = $user->id;

            $amount  = $this->responded_amount-$this->sent_amount;
            return $amount;
        }
        return 0;
    }


    static public function getSlugName($fullname) {
        $slug = str_slug($fullname, '-');
        $userRows = User::whereRaw("username REGEXP '^{$slug}(-[0-9]*)?$'")->get();
        $countUser = count($userRows) + 1;

        return ($countUser > 1) ? "{$slug}-{$countUser}" : $slug;
    }
}
