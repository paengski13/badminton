<?php

class Debt extends Eloquent
{
    protected $table = 'debt';
    protected $guarded = array('id');
    
    use SoftDeletingTrait;
    
    // search for debt key
    public function scopeDebtKey($query, $debt_key)
    {
        return $query->where('debt_key', 'LIKE', $debt_key);
    }
	
    // search for debt name
    public function scopeDebtName($query, $debt_name)
    {
        return $query->where('debt_name', 'LIKE', "%$debt_name%");
    }
    
    // search for debt status
    public function scopeDebtStatus($query, $debt_status)
    {
        if (!empty($debt_status)) {
            return $query->where('debt_status', 'LIKE', $debt_status);
        
        }
    }
    
    // sort for debt record
    public function scopeDebtSort($query, $sort_by = 'created_at', $order_by)
    {
        return $query->orderBy($sort_by, $order_by);
        
    }

}