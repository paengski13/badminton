<?php

class Access extends Eloquent
{
    protected $table = 'access';
    protected $guarded = array('id');
    
    public function user()
    {
        return $this->belongsToMany('User');
    }
	
    // search for access status
    public function scopeAccessStatus($query, $access_status)
    {
        if (!empty($access_status)) {
            return $query->where('access_status', 'LIKE', $access_status);
        
        }
    }
    
    // sort for access record
    public function scopeAccessSort($query, $sort_by = 'access_sort', $order_by)
    {
        return $query->orderBy($sort_by, $order_by);
        
    }
}