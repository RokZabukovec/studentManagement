<?php

function loggedOutMenu(){
        $menu = array(
            "Login" => "login.php",
            "Register" => "register.php",
            "Home" => "index.php"
        );
        echo "<nav>";
        echo "<ul>";
        echo "<nav class='navbar navbar-expand-lg navbar-dark bg-dark'>";
            echo "<a class='navbar-brand' href='/index.php'>Student Management</a>";
            echo "<button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarColor02' aria-controls='navbarColor02' aria-expanded='false' aria-label='Toggle navigation'>";
                echo "<span class='navbar-toggler-icon'></span>";
            echo "</button>";

            echo "<div class='collapse navbar-collapse' id='navbarColor02'>";
                echo "<ul class='navbar-nav ml-auto'>";
                foreach ($menu as $menuItemName => $menuItemLink){
                    echo "<li class='nav-item'><a class='nav-link' href='{$menuItemLink}'>{$menuItemName}</a></li>";
                }
                echo "</ul>";
        echo "</nav>";
}


function functionsMenu(){
    $menu = array(
        "Students" => "students.php",
        "Subjects" => "subjects.php",
        "Professors" => "professors.php",
        "Logout" => "logout.php",
        "Profile" => "profile.php",
        "Home" => "index.php"
    );
    echo "<nav>";
    echo "<ul>";
    echo "<nav class='navbar navbar-expand-lg navbar-dark bg-dark'>";
    echo "<a class='navbar-brand' href='/index.php'>Student Management</a>";
    echo "<button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarColor02' aria-controls='navbarColor02' aria-expanded='false' aria-label='Toggle navigation'>";
    echo "<span class='navbar-toggler-icon'></span>";
    echo "</button>";

    echo "<div class='collapse navbar-collapse' id='navbarColor02'>";
    echo "<ul class='navbar-nav ml-auto'>";
    foreach ($menu as $menuItemName => $menuItemLink){
        echo "<li class='nav-item'><a class='nav-link' href='{$menuItemLink}'>{$menuItemName}</a></li>";
    }
    echo "</ul>";
    echo "</nav>";
}
