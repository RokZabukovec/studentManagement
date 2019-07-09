<?php


echo "<nav class='navbar navbar-expand-lg navbar-dark bg-dark'>";
  echo "<a class='navbar-brand' href='/index.php'>Student Management</a>";
  echo "<button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarColor02' aria-controls='navbarColor02' aria-expanded='false' aria-label='Toggle navigation'>";
    echo "<span class='navbar-toggler-icon'></span>";
  echo "</button>";

  echo "<div class='collapse navbar-collapse' id='navbarColor02'>";
    echo "<ul class='navbar-nav ml-auto'>";
     echo " <li class='nav-item active'>";
       echo " <a class='nav-link' href='#'>Home <span class='sr-only'>(current)</span></a>";
     echo " </li>";
      echo "<li class='nav-item'>";
        echo "<a class='nav-link' href='#'>Features</a>";
      echo "</li>";
    echo "</ul>";
  echo "</div>";
echo "</nav>";