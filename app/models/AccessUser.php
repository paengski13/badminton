<?php

class AccessUser extends Eloquent
{
    protected $table = 'access_user';
    protected $guarded = array('id');
    
    // search for user
    public function scopeUserId($query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }
    
    // search for access
    public function scopeAccessId($query, $access_id)
    {
        return $query->where('access_id', $access_id);
    }
    
    // search for access user flag
    public function scopeAccessUserFlag($query, $access_user_flag)
    {
        return $query->where('access_user_flag', $access_user_flag);
    }
    
}