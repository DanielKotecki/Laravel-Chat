<?php
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel(/**
 * @param $user
 * @param $id
 * @return bool
 */ 'App.Models.User.{id}', function ($user, $id) {
    return (int)$user->id === (int)$id;
});

Broadcast::channel(/**
 * @param $user
 * @return array|false
 */ 'room', function ($user) {

    if (isset($user->id)) {
        return [
            'id' => $user->id,
            'name' => $user->name ?? $user->id,
            'sessionId' => $user->session_id ?? ''
        ];
    }
    return false;
});
Broadcast::channel(/**
 * @param $user
 * @param $userId
 * @return bool
 */ 'users.{userId}', function ($user, $userId) {
    return (int)$user->id === (int)$userId;
});

Broadcast::channel(/**
 * @param $user
 * @param $channelId
 * @return array
 */ 'chat.{channelId}', function ($user, $channelId) {
    return [
        'id' => $user->id,
        'name' => $user->name ?? $user->id,
        'sessionId' => $user->session_id ?? ''
    ];

});
