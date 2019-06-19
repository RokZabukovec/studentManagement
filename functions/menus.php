<?php

function loggedOutMenu(){
        $menu = array(
            "Login" => "login.php",
            "Register" => "register.php",
            "Home" => "index.php"
        );
        echo "<nav>";
        echo "<ul>";
        foreach ($menu as $menuItemName => $menuItemLink){
            echo "<li><a href='{$menuItemLink}'>{$menuItemName}</a></li>";
        }
        echo "</ul>";
        echo "</nav>";
}

function loggedInMenu(){
    $menu = array(
        "Logout" => "logout.php",
        "Profile" => "profile.php",
        "Home" => "index.php"
    );
    echo "<nav>";
    echo "<ul>";
    foreach ($menu as $menuItemName => $menuItemLink){
        echo "<li><a href='{$menuItemLink}'>{$menuItemName}</a></li>";
    }
    echo "</ul>";
    echo "</nav>";
}

function functionsMenu(){
    $menu = array(
        "Students" => "students.php",
        "Subjects" => "subjects.php",
        "Professors" => "professors.php",
    );
    echo "<nav>";
    echo "<ul>";
    foreach ($menu as $menuItemName => $menuItemLink){
        echo "<li><a href='{$menuItemLink}'>{$menuItemName}</a></li>";
    }
    echo "</ul>";
    echo "</nav>";
}
