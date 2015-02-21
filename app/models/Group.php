<?php

class Group extends Eloquent
{
    protected $table = 'group';
    protected $guarded = array('id');
    
    use SoftDeletingTrait;
}