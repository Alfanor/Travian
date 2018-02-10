$(function() {
    $("#onglets").tabs();		
});

<?php
if($_GET['action'] == 1)
{
    echo '$(document).ready(function() {$("#onglets").tabs("option", "active", 3);});';
}

if($_GET['action'] == 2)
{
    echo '$(document).ready(function() {$("#onglets").tabs("option", "active", 4);});';
}
?>