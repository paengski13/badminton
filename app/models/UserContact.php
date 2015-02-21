<?php

class UserContact extends Eloquent
{
    protected $table = 'user_contact';
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
    
    // search for user adress status
    public function scopeUserId($query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }
    
    // search for user contact key
    public function scopeUserContactKey($query, $user_contact_key)
    {
        return $query->where('user_contact_key', 'LIKE', $user_contact_key);
    }

}