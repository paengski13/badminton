<?php

class Country extends Eloquent
{
    protected $table = 'country';
    protected $guarded = array('id');
    
    use SoftDeletingTrait;
    
    // search for country key
    public function scopeCountryKey($query, $country_key)
    {
        return $query->where('country_key', 'LIKE', $country_key);
    }
	
    // search for country name
    public function scopeCountryName($query, $country_name)
    {
        return $query->where('country_name', 'LIKE', "%$country_name%");
    }
    
    // search for country status
    public function scopeCountryStatus($query, $country_status)
    {
        if (!empty($country_status)) {
            return $query->where('country_status', 'LIKE', $country_status);
        
        }
    }
    
    // sort for country record
    public function scopeCountrySort($query, $sort_by = 'created_at', $order_by)
    {
        return $query->orderBy($sort_by, $order_by);
        
    }
    
    // concat country name and call
    public function getCountryCallAttribute()
    {
        return $this->attributes['country_name'] . ' (+' . $this->attributes['country_call'] . ')';
    }

}