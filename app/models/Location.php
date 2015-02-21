<?php

class Location extends Eloquent
{
    protected $table = 'location';
    protected $guarded = array('id');
    
    use SoftDeletingTrait;
    
    // search for location key
    public function scopeLocationKey($query, $location_key)
    {
        return $query->where('location_key', 'LIKE', $location_key);
    }
	
    // search for location name
    public function scopeLocationName($query, $location_name)
    {
        return $query->where('location_name', 'LIKE', "%$location_name%");
    }
    
    // search for location status
    public function scopeLocationStatus($query, $location_status)
    {
        if (!empty($location_status)) {
            return $query->where('location_status', 'LIKE', $location_status);
        
        }
    }
    
    // sort for location record
    public function scopeLocationSort($query, $sort_by = 'created_at', $order_by)
    {
        return $query->orderBy($sort_by, $order_by);
        
    }

}