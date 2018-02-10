<!DOCTYPE html>
	<html>
		<head>
			<title><?php echo $_TITRE; ?></title>
		
			<meta charset="UTF-8">	
            
            <?php
            foreach($_HEADER as $fichier)
                echo $fichier;
                
            foreach($_CSS as $fichier)
                echo '<link href="Vues/Css/' . $fichier . '" rel="stylesheet" type="text/css" />';
                
             foreach($_JS as $fichier)
                echo '<script src="Vues/Javascript/' . $fichier . '"></script>';
            ?>
            
		</head>
		<body>	
			<div class="conteneur">
