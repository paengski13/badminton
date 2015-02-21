<?php

class Rank extends Eloquent
{
    protected $table = 'rank';
    protected $guarded = array('id');
    
    use SoftDeletingTrait;
    
    // search for rank key
    public function scopeRankKey($query, $rank_key)
    {
        return $query->where('rank_key', 'LIKE', $rank_key);
    }
	
    // search for rank name
    public function scopeRankName($query, $rank_name)
    {
        return $query->where('rank_name', 'LIKE', "%$rank_name%");
    }
    
    // search for rank status
    public function scopeRankStatus($query, $rank_status)
    {
        if (!empty($rank_status)) {
            return $query->where('rank_status', 'LIKE', $rank_status);
        
        }
    }
    
    // sort for rank record
    public function scopeRankSort($query, $sort_by = 'created_at', $order_by)
    {
        return $query->orderBy($sort_by, $order_by);
        
    }

}