<?php

	define( 'TIMEBEFORE_NOW','now' );
    define( 'TIMEBEFORE_MINUTE','{num} minute ago' );
    define( 'TIMEBEFORE_MINUTES','{num} minutes ago' );
    define( 'TIMEBEFORE_HOUR', '{num} hour ago' );
    define( 'TIMEBEFORE_HOURS', '{num} hours ago' );
    define( 'TIMEBEFORE_YESTERDAY', 'yesterday' );
    define( 'TIMEBEFORE_FORMAT',  '%e %b' );
    define( 'TIMEBEFORE_FORMAT_YEAR', '%e %b, %Y' );

    define( 'TIMEBEFORE_DAYS',    '{num} days ago' );
	define( 'TIMEBEFORE_WEEK',    '{num} week ago' );
	define( 'TIMEBEFORE_WEEKS',   '{num} weeks ago' );
	define( 'TIMEBEFORE_MONTH',   '{num} month ago' );
	define( 'TIMEBEFORE_MONTHS',  '{num} months ago' );

	date_default_timezone_set("Africa/Lagos");


	function login()
	{
		if(isset($_SESSION['matric'])){
			return true;
		}else{
			return false;
		}
	}

	function admin()
	{
		if(!isset($_SESSION['admin'])){
			return false;
		}else{
			return true;
		}
	}


	function set_flash($msg,$type)
	{
		$_SESSION['flash'] = "<div class='alert alert-".$type."'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$msg."</div>";
	}

	function flash()
	{
		if(isset($_SESSION['flash']))
		{
			echo $_SESSION['flash'];
			unset($_SESSION['flash']);
		}
	}

	function num_formats($n)
	{
		$l = strlen($n);
		if($l == 1){
			return "00".$n;
		}elseif ($n == 2) {
			return "0".$n;
		}else{
			return $n;
		}
	}

	function admin_role($n)
	{
		if($n == 0){
			return "Moderator";
		}elseif ($n == 1) {
			return "Global Admin";
		}
	}


	function time_ago($time)
    {
        $out    = ''; // what we will print out
        $now    = time(); // current time
        $diff   = $now - $time; // difference between the current and the provided dates

        if( $diff < 60 ) // it happened now
            return TIMEBEFORE_NOW;

        elseif( $diff < 3600 ) // it happened X minutes ago
            return str_replace( '{num}', ( $out = round( $diff / 60 ) ), $out == 1 ? TIMEBEFORE_MINUTE : TIMEBEFORE_MINUTES );

        elseif( $diff < 3600 * 24 ) // it happened X hours ago
            return str_replace( '{num}', ( $out = round( $diff / 3600 ) ), $out == 1 ? TIMEBEFORE_HOUR : TIMEBEFORE_HOURS );

        elseif( $diff < 3600 * 24 * 2 ) // it happened yesterday
            return TIMEBEFORE_YESTERDAY;

        elseif( $diff < 3600 * 24 * 7 )
        return str_replace( '{num}', round( $diff / ( 3600 * 24 ) ), TIMEBEFORE_DAYS );

	    elseif( $diff < 3600 * 24 * 7 * 4 )
	        return str_replace( '{num}', ( $out = round( $diff / ( 3600 * 24 * 7 ) ) ), $out == 1 ? TIMEBEFORE_WEEK : TIMEBEFORE_WEEKS );

	    elseif( $diff < 3600 * 24 * 7 * 4 * 12 )
	        return str_replace( '{num}', ( $out = round( $diff / ( 3600 * 24 * 7 * 4 ) ) ), $out == 1 ? TIMEBEFORE_MONTH : TIMEBEFORE_MONTHS );


        else // falling back on a usual date format as it happened later than yesterday
            return strftime( date( 'Y', $time ) == date( 'Y' ) ? TIMEBEFORE_FORMAT : TIMEBEFORE_FORMAT_YEAR, $time );
    }

    function settings($name)
    {
    	global $db;
    	$set = $db->prepare('SELECT value FROM settings WHERE name = :name');
    	$set->execute(array('name' => $name));
    	$rs = $set->fetch(PDO::FETCH_ASSOC);
    	return $rs['value'];
    	$set->closeCursor();
    }

    function alert($msg,$type,$close = false)
    {
        if($close == false){
            $msg = "<div class='alert alert-".$type."'>".$msg."</div>";
        }else{
            $msg = "<div class='alert alert-".$type."'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$msg."</div>";
        }

        echo $msg;
    }


    function user_details($id,$field)
    {
    	global $db;
    	$set = $db->prepare('SELECT * FROM students WHERE matric = :id');
    	$set->execute(array('id' => $id));
    	$rs = $set->fetch(PDO::FETCH_ASSOC);
    	return $rs[$field];
    	$set->closeCursor();
    }

    function staff_details($id,$field)
    {
        global $db;
        $set = $db->prepare('SELECT * FROM staff WHERE id = :id');
        $set->execute(array('id' => $id));
        $rs = $set->fetch(PDO::FETCH_ASSOC);
        return $rs[$field];
        $set->closeCursor();
    }

function log_user($field)
{
    global $db;
    $id = $_SESSION['matric'];
    $set = $db->prepare('SELECT * FROM students WHERE matric = :id');
    $set->execute(array('id' => $id));
    $rs = $set->fetch(PDO::FETCH_ASSOC);
    $set->closeCursor();
    return $rs[$field];

}

    function user($field)
    {
        global $db;
        $id = $_SESSION['matric'];
        $set = $db->prepare('SELECT * FROM students WHERE matric = :id');
        $set->execute(array('id' => $id));
        $rs = $set->fetch(PDO::FETCH_ASSOC);
        $set->closeCursor();
        return $rs[$field];
    }


	function site_name(){
		return "FPE - ADMIN";
	}

	function venue_status($s){
		if($s == 1){
			return "Active";
		}else{
			return "Disabled";
		}
	}

	function dept($id){
	    global $db;

	    $sql = $db->query("SELECT name FROM department WHERE id = '$id'");
	    $rs = $sql->fetch(PDO::FETCH_ASSOC);
	    $sql->closeCursor();
	    return $rs['name'];
    }

    function dept_id($id){
        global $db;

        $sql = $db->query("SELECT id FROM department WHERE name = '$id'");
        $rs = $sql->fetch(PDO::FETCH_ASSOC);
        $sql->closeCursor();
        return $rs['id'];
    }

    function course($id,$f){
        global $db;

        $sql = $db->query("SELECT * FROM course_pool WHERE id = '$id'");
        $rs = $sql->fetch(PDO::FETCH_ASSOC);
        $sql->closeCursor();
        return $rs[$f];
    }

    function points($score){
        if(($score >= 75) && ($score <= 100)){
            return 4;
        }
        elseif (($score >= 70) && ($score < 74)){
            return 3.5;
        }
        elseif (($score >= 65) && ($score < 70)){
            return 3.25;
        }elseif (($score >= 60) && ($score < 65)){
            return 3;
        }elseif (($score >= 55) && ($score < 60)){
            return 2.75;
        }elseif (($score >= 50) && ($score < 55)){
            return 2.5;
        }
        elseif (($score >= 45) && ($score < 50)){
            return 2.25;
        }
        elseif (($score >= 40) && ($score < 45)){
            return 2;
        }else{
            return 0;
        }

    }


function grade($score){
    if(($score >= 75) && ($score <= 100)){
        return "A";
    }
    elseif (($score >= 70) && ($score < 74)){
        return "AB";
    }
    elseif (($score >= 65) && ($score < 70)){
        return "B";
    }elseif (($score >= 60) && ($score < 65)){
        return "BC";
    }elseif (($score >= 55) && ($score < 60)){
        return "C";
    }elseif (($score >= 50) && ($score < 55)){
        return "D";
    }
    elseif (($score >= 45) && ($score < 50)){
        return "DE";
    }
    elseif (($score >= 40) && ($score < 45)){
        return "D";
    }else{
        return "F";
    }

}



?>