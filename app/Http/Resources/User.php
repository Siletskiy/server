<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        static $cdn = false;
        if ($cdn === false) {
            $cdn = config('fixtures.cdn_url');
        }
        /** @var \App\User|null $user */
        $user = $request->user();
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'photo' => $this->photo
                ? $cdn ? $cdn . $this->photo : Storage::cloud()->url($this->photo)
                : null,
            'username' => $this->username,
            'bio' => $this->bio,
            'verified' => $this->verified,
            'business' => $this->business,
            'links' => $this->links,
            'location' => $this->location,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'created_at' => $this->created_at->toIso8601String(),
            'updated_at' => $this->updated_at->toIso8601String(),
            'followers_count' => $this->followers_total,
            'followed_count' => $this->followings_total,
            'clips_count' => $this->clips_total,
            'likes_count' => $this->likes_total,
            'views_count' => $this->views_total,
            'me' => $user && $this->id === $user->id,
            'follower' => $user && $user->isFollowedBy($this->resource),
            'followed' => $user && $user->isFollowing($this->resource),
            'blocked' => $user && $user->isBlockedBy($this->resource),
            'blocking' => $user && $user->isBlocking($this->resource),
        ];
        if ($level = $this->level) {
            $data['level'] = [
                'name' => $level->name,
                'color' => $level->color,
            ];
        }
        if ($data['me']) {
            $data += [
                'email' => $this->email,
                'phone' => $this->phone,
                'redemption_mode' => $this->redemption_mode,
                'redemption_address' => $this->redemption_address,
            ];
        }
        return $data;
    }
}
