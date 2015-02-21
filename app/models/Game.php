<?php

class Game extends Eloquent
{
    protected $table = 'game';
    protected $guarded = array('id');
    
    use SoftDeletingTrait;
    
	public function location() 
    {
        return $this->belongsTo('Location');
    }
    
	public function debt() 
    {
        return $this->belongsTo('Debt');
    }
    
    // search for game key
    public function scopeGameKey($query, $game_key)
    {
        return $query->where('game_key', 'LIKE', $game_key);
    }
	
    // search for game name
    public function scopeGameName($query, $game_name)
    {
        return $query->where('game_name', 'LIKE', "%$game_name%");
    }
    
    // search for game status
    public function scopeGameStatus($query, $game_status)
    {
        if (!empty($game_status)) {
            return $query->where('game_status', 'LIKE', $game_status);
        
        }
    }
    
    // sort for game record
    public function scopeGameSort($query, $sort_by = 'created_at', $order_by)
    {
        return $query->orderBy($sort_by, $order_by);
        
    }

}