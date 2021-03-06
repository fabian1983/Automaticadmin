<?php

// DATABASE 
require "../DB_website.xx.php";

// init session
$session_max_seconds = 1800;
ini_set('session.gc_maxlifetime', $session_max_seconds); // garbage collect session after x minutes
session_set_cookie_params($session_max_seconds); // cookie should have same expire date
session_start();


//Time stamp
$datetime = date("Y-m-d H:i:s");
$currentdate = date("Y-m-d");
$currentyear = date("Y");
$currentmonth = date("m");
$currentday = date("d");
$currenttime = date("H:i:s");
$currenthour = date("H");
$currentminute = date("m");
$currentsecond = date("s");

//Tracking info
$ip = $_SERVER['REMOTE_ADDR'];
$hostnameip = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$useragent = $_SERVER['HTTP_USER_AGENT'];


// Site direction Switchcases
$page = htmlspecialchars($_GET['page']);
$action = htmlspecialchars($_GET['action']); //CRUD Create Read Update Delete
$step = htmlspecialchars($_GET['step']);
$id = htmlspecialchars($_GET['id']); // for favorites	

function requiresLogin()
{
    if (empty($_SESSION['loggedin'])) {
        header("location: ?page=Login");
        exit();
    }
}

function checkLocked()
{
    $allowedPages = ['Lock', 'Login', 'Logout']; // alle pages die bereikbaar zijn als je locked bent
    if (in_array($_GET['page'], $allowedPages)) {
        return false; // sla de functie over, als je pagina in allowedPages staat.
    }

    // als je sessie locked is, redirect naar lock page
    if (isset($_SESSION['locked']) && $_SESSION['locked'] === true) {
        header("location: ?page=Lock");
        exit();
    }
}

// altijd controleren of je sessie "locked" is
checkLocked();

if (!empty($page)) {
    // pindex.nl
    $title_page = " | $page ";
  }
  elseif ($page == "") {
    // pindex.nl
    $title_page = "";

    //als het moet... $page="Welkom";
  }


switch ($page) {
    
    case 'Login':
        require "pages/login/login.php";
        break;

    case 'Login2':
        require "testlogin/index.php";
        break;
        

    case 'Logout':
        requiresLogin();
        require "pages/login/logout.php";
        break;

    default:    
    $pageError="Pagenotfound";
    require "pages/default/index.php";

}
