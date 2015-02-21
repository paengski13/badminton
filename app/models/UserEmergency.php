<?php

class UserEmergency extends Eloquent
{
    protected $table = 'user_emergency';
    protected $guarded = array('id');
    
    use SoftDeletingTrait;
    
	public function user() 
    {
        return $this->belongsTo('User');
    }
    
	public function country() 
    {
        return $this->belongsTo('Country');
    }
    
    // search for user emergency status
    public function scopeUserId($query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }
    
    // search for user emergency key
    public function scopeUserEmergencyKey($query, $user_emergency_key)
    {
        return $query->where('user_emergency_key', 'LIKE', $user_emergency_key);
    }

}