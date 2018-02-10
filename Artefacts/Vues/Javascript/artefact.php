function validerArtefact(id_artefact)
{
    $.getJSON(  "Ajax/artefact.php", 
                {id : id_artefact}, 
                function(json) {
                    if(json.retour == '3')
                    {
                        $(".duree_arte_" + id_artefact).css("background-color", "#4fb0fb");
                    }
                
                    else if(json.retour == '2')
                    {
                        $(".duree_arte_" + id_artefact).css("background-color", "white");
                    }
                    
                    else if(json.retour == '1')
                        alert('erreur');
                });
}  

function validerVillage(id_village)
{
    $.getJSON(  "Ajax/village.php", 
                {id : id_village}, 
                function(json) {
                    if(json.retour == '3')
                    {
                        $(".duree_village_" + id_village).css("background-color", "#4fb0fb");
                        $(".check_" + id_village).prop('checked', true);
                    }
                
                    else if(json.retour == '2')
                    {
                        $(".duree_village_" + id_village).css("background-color", "white");
                        $(".check_" + id_village).prop('checked', false);
                    }
                    
                    else if(json.retour == '1')
                        alert('erreur');
                });
} 

$(function() {
    $("#onglets").tabs();		
});

function changerOnglet(type)
{
    if(type == "unique")
    {
        $(".off_unique").css("display", "table-row");
        $(".off_majeur").css("display", "none");
        $(".off_mineur").css("display", "none");
    }

    if(type == "majeur")
    {
        $(".off_unique").css("display", "table-row");
        $(".off_majeur").css("display", "table-row");
        $(".off_mineur").css("display", "none");
    }

    if(type == "mineur")
    {
        $(".off_unique").css("display", "table-row");
        $(".off_majeur").css("display", "table-row");
        $(".off_mineur").css("display", "table-row");
    }
}

<?php
require_once('../../Classes/Artefact.php');

if(isset($_GET['id']) && is_numeric($_GET['id']))
{
    if(in_array($_GET['id'], Artefact::$majeur_id))
        echo '$(document).ready(function() {$("#onglets").tabs("option", "active", 1);});';
        
    if(in_array($_GET['id'], Artefact::$mineur_id))
        echo '$(document).ready(function() {$("#onglets").tabs("option", "active", 2);});';
}

if(isset($_GET['action']) && $_GET['action']  == 1)
{
    echo '$(document).ready(function() {$("#onglets").tabs("option", "active", 3);});';
}

if(isset($_GET['action']) && $_GET['action']  == 2)
{
    echo '$(document).ready(function() {$("#onglets").tabs("option", "active", 4);});';
}
?>