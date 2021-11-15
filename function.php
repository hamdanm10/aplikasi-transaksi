<?php
function activeMenu($value)
{
    if (isset($_GET['page'])) {
        if ($_GET['page'] == $value) {
            echo ' active';
        }
    }
}

function alertValidate($text, $color)
{
    echo "<div class='alert alert-" . $color . " alert-dismissible fade show' role='alert'>" . $text . "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
}
