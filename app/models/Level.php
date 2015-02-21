<?php

class Level extends Eloquent
{
    protected $table = 'level';
    protected $guarded = array('id');
    
    use SoftDeletingTrait;
    
    // search for level key
    public function scopeLevelKey($query, $level_key)
    {
        return $query->where('level_key', 'LIKE', $level_key);
    }
	
    // search for level name
    public function scopeLevelName($query, $level_name)
    {
        return $query->where('level_name', 'LIKE', "%$level_name%");
    }
    
    // search for level status
    public function scopeLevelStatus($query, $level_status)
    {
        if (!empty($level_status)) {
            return $query->where('level_status', 'LIKE', $level_status);
        
        }
    }
    
    // sort for level record
    public function scopeLevelSort($query, $sort_by = 'created_at', $order_by)
    {
        return $query->orderBy($sort_by, $order_by);
        
    }

}