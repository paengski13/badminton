<?php

class Tournament extends Eloquent
{
    protected $table = 'tournament';
    protected $guarded = array('id');
    
    use SoftDeletingTrait;
    
    // search for tournament key
    public function scopeTournamentKey($query, $tournament_key)
    {
        return $query->where('tournament_key', 'LIKE', $tournament_key);
    }
	
    // search for tournament name
    public function scopeTournamentName($query, $tournament_name)
    {
        return $query->where('tournament_name', 'LIKE', "%$tournament_name%");
    }
    
    // search for tournament status
    public function scopeTournamentStatus($query, $tournament_status)
    {
        if (!empty($tournament_status)) {
            return $query->where('tournament_status', 'LIKE', $tournament_status);
        
        }
    }
    
    // sort for tournament record
    public function scopeTournamentSort($query, $sort_by = 'created_at', $order_by)
    {
        return $query->orderBy($sort_by, $order_by);
        
    }

}