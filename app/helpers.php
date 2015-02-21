<?php
// option fix gender
function getOptionGender($status = '')
{
    $gender_arr = array();
    
	$gender_arr[MALE] = 'Male';
	$gender_arr[FEMALE] = 'Female';
    
    return $gender_arr;
}

// option relationship
function getOptionRelationship($status = '')
{
    $relationship_arr = array();
    
	$relationship_arr[HUSBAND] = 'Husband';
	$relationship_arr[WIFE] = 'Wife';
	$relationship_arr[MOTHER] = 'Mother';
	$relationship_arr[FATHER] = 'Father';
	$relationship_arr[SON] = 'Son';
	$relationship_arr[DAUGHTER] = 'Daughter';
	$relationship_arr[FAMILY_RELATIVE] = 'Family Relative';
	$relationship_arr[BOYFRIEND] = 'Boyfriend';
	$relationship_arr[GIRLFRIEND] = 'Girlfriend';
	$relationship_arr[FRIEND] = 'Friend';
	$relationship_arr[OTHERS] = 'Others';
    
    return $relationship_arr;
}

// option fix civil status
function getOptionCivilStatus($status = '')
{
    $civil_status_arr = array();
    
	$civil_status_arr[SINGLE] = 'Single';
	$civil_status_arr[MARRIED] = 'Married';
	$civil_status_arr[DIVORCE] = 'Divorce';
	$civil_status_arr[WIDOWED] = 'Widowed';
    
    return $civil_status_arr;
}

// option fix status
function getOptionStatus($status = '')
{
    $status_arr = array();
    
	$status_arr[ACTIVE] = 'Active';
    
    if ($status == USER_TITLE) {
        $status_arr[LOCKED] = 'Locked';
    }
    
	$status_arr[INACTIVE] = 'Inactive';
    
    return $status_arr;
}

// sort order
function getSortOrder($sort_order = "")
{
    if ($sort_order == ASCENDING) {
        return DESCENDING;
        
    } else if ($sort_order == DESCENDING) {
        return ASCENDING;
        
    } else {
        
    }
}

// random ID when updating record
function generateRandomID()
{
    return uniqid(date("ymd"));
}

// display last query executed
function printLastQuery()
{
    $queries = DB::getQueryLog();
    print_r(end($queries));
}

// iterate record
function printResult($arr) {
    if (is_array($arr)) {
        foreach($arr as $rec){echo"<pre>";print_r($rec);echo"</pre>";}
    } else {
        foreach($arr as $x) { echo"<pre>";print_r($x);echo"</pre>";}
    }
}


