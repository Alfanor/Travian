<div id="onglets">
	<ul>
		<li><a href="#onglets-1" onclick="changerOnglet('unique')">Artefacts uniques</a></li>
		<li><a href="#onglets-2" onclick="changerOnglet('majeur')">Artefacts majeurs</a></li>
		<li><a href="#onglets-3" onclick="changerOnglet('mineur')">Artefacts mineurs</a></li>
		<li><a href="#onglets-4">Saisir artefacts</a></li>
		<li><a href="#onglets-5">Villages offensifs</a></li>
	</ul>

	<?php
	$liste_tour = array('unique', 'majeur', 'mineur');

	for($i = 0; $i < 3; $i++)
	{
	?>

		<div id="onglets-<?php echo ($i + 1); ?>">
			<!-- On commence par faire le tableau des villages offensifs -->          
			<div class="conteneur_tableau_gauche">
				<table class="tableau_gauche">
					<tbody>
						<tr>
							<th colspan="8" class="case_vide case_artefact"></th>      
						</tr>
						
						<tr>
							<th class="case_petite">V</th>
							<th class="case_normale">Joueur</th>
							<th class="case_petite">X</th>
							<th class="case_petite">Y</th>
							<th class="case_petite">PT</th>
							<th class="case_normale">Bottes</th>
							<th class="case_petite">CDT</th>
							<th class="case_normale">Cible</th>
						</tr>
						<?php
						foreach($liste_villages as $village)
						{ 
								($village->getValider() == 1) ? ($check = 'checked') : ($check = '');
								($village->getValider() == 1) ? ($style = 'background-color : #4fb0fb;') : ($style = '');
								
								echo '<tr class="off_' . $village->getCible() . '">';
								echo '<td class="case_petite texte_centrer"><a href="#" onclick="validerVillage(' . $village->getId() . ')">V</a></td>';
								
								echo '<td class="case_normale duree_village_' . $village->getId() . '" style="' . $style . '">' . $village->getProprietaire() . '</td>';echo "\r\n\t\t\t\t";
								echo '<td class="texte_centrer case_petite duree_village_' . $village->getId() . '" style="' . $style . '">' . $village->getX() . '</td>';echo "\r\n\t\t\t\t";
								echo '<td class="texte_centrer case_petite duree_village_' . $village->getId() . '" style="' . $style . '">' . $village->getY() . '</td>';echo "\r\n\t\t\t\t";
								echo '<td class="texte_centrer case_petite duree_village_' . $village->getId() . '" style="' . $style . '">' . $village->getPt() . '</td>';echo "\r\n\t\t\t\t";

								if($village->getBottes() != null)
								{
									echo '<td class="texte_centrer case_normale duree_village_' . $village->getId() . '"" style="' . $style . '">+' . VillageOffensif::$vitesse_botte[$village->getBottes()] . '%</td>';echo "\r\n\t\t\t\t";
								}

								else
								{
									echo '<td class="texte_centrer case_normale duree_village_' . $village->getId() . '"" style="' . $style . '">-</td>';echo "\r\n\t\t\t\t";
								}

								echo '<td class="texte_centrer case_petite duree_village_' . $village->getId() . '"" style="' . $style . '">' . $village->getCDT() . '</td>';echo "\r\n\t\t\t\t";
								echo '<td class="texte_centrer case_normale duree_village_' . $village->getId() . '"" style="' . $style . '">' . ucfirst($village->getCible()) . '</td>';echo "\r\n\t\t\t\t";      
								
								echo '</tr>';
						}
						?>
						
						<tr>
							<td class="texte_centrer case_td_en_th" colspan="8">Validation</td>
						</tr>
					</tbody>
				</table>
			</div>
			
			<div class="conteneur_tableau_droit">
				<table>
					<thead>
						<tr>
						  <?php					
							foreach($liste_artefacts as $artefact)
							{
								if($artefact->getType() == $liste_tour[$i])
								{
									echo '<th class="case_grande case_artefact" colspan="2">' . $artefact->getNom() . '<br /> <a href="?p=artefact&amp;id=' . $artefact->getId() . '">Trier</a></th>';
									echo "\r\n\t\t\t\t";
								}
							}
							?>   
						</tr>
						
						<tr>
							<?php
							foreach($liste_artefacts as $artefact)
							{
								if($artefact->getType() == $liste_tour[$i])
								{
									echo '<th class="texte_centrer case_th_en_td th_gauche_pas_de_bordure_basse">' . $artefact->getX() . '</th>';echo "\r\n\t\t\t\t";
									echo '<th class="texte_centrer case_th_en_td th_gauche_pas_de_bordure_basse">' . $artefact->getY() . '</th>';echo "\r\n\t\t\t\t";
								}
							}
							?>
						</tr>
					</thead>
					
					<tbody class=".linked">
						<?php
						foreach($liste_villages as $village)
						{
							if(($liste_tour[$i] == 'unique' && ($village->getCible() == $liste_tour[$i] || $village->getCible() == 'tournante')) ||
								($liste_tour[$i] == 'majeur' && ($village->getCible() == $liste_tour[$i] || $village->getCible() == 'unique' || $village->getCible() == 'tournante')) ||
								($liste_tour[$i] == 'mineur'))
							{
								echo '<tr class="off_unique">';
								
								foreach($liste_artefacts as $artefact)
								{
									if($artefact->getType() == $liste_tour[$i])
									{
										$duree = $distances[$artefact->getId()][$village->getId()];
										
										if($duree[1] < 10)
											$duree[1] = '0' . $duree[1] ;
											
										($artefact->getValider() == 1 || $village->getValider() == 1) ? ($style = 'background-color : #4fb0fb;') : ($style = '');
										($village->getId() == $distances[$artefact->getId()][0]) ? ($style = 'background-color : #70d643;') : ($style = $style);
										
										echo '<td class="texte_centrer duree_arte_' . $artefact->getId() . ' duree_village_' . $village->getId() . ' case_grande" style="' . $style . '" colspan="2">'. $duree[0] . 'h' . $duree[1] . '</td>';echo "\r\n\t\t\t\t";
									}   
								}
						   }
							
							echo '</tr>';
						}
						?>
						
						<!-- Gestion de la validation -->					
						<tr>
							<?php
							foreach($liste_artefacts as $artefact)
							{
								if($artefact->getType() == $liste_tour[$i])
								{
									($artefact->getValider() == 1) ? ($check = 'checked') : ($check = '');
									
									echo '<td class="nom texte_centrer" colspan="2"><a href="#" onclick="validerArtefact(' . $artefact->getId() . ')">V</a></td>';
								}
							}
							?>
						</tr>
					</tbody>
				</table>
			</div>

			<div style="clear : both;"></div>
			</div>

		<?php
		}
		?>

		<div id="onglets-4">
			<?php
			if($success == true && $action == 1)
			echo '<p>Les artefacts ont été mis à jour.</p>';

			if($success == false && $action == 1)
			echo '<p>Une erreur est survenue, vérifiez votre saisie.</p>';
			?>

			<p>Afin d'enregistrer les coordonnées des artefacts, veuillez vous rendre dans une CDT, dans l'onglet majeur puis l'onglet mineur et respecter les étapes suivants :</p>
			<ul class="normale">
			<li>Cliquer droit sur la page</li>
			<li>Afficher le code source</li>
			<li>Ctrl + a</li>
			<li>Ctrl + c</li>
			<li>Retourner sur la page actuelle</li>
			<li>Ctrl + v dans le champ de saisi ci-dessous</li>
			<li>Valider le formulaire</li>
			</ul>

			<form method="post" action="?p=artefact&amp;action=1">
			<textarea name="code" style="width : 500px; height : 300px;"></textarea><br/><br />

			<input type="submit" value="Envoyer" />
			</form>
		</div>	

		<div id="onglets-5">
			<p>Ici vous pouvez ajouter un village offensif ou en mettre un à jour si vous saisissez les coordonnées d'un village déjà enregistré.</p>

			<?php
			if($success == true && $action == 2)
			echo '<p>Le village offensif a bien été ajouté ou mis à jour.</p>';

			if($success == false && $action == 2)
			echo '<p>Une erreur est survenue, vérifiez votre saisie.</p>';
			?>

			<form method="post" action="?p=artefact&amp;action=2">
				<p><label for="proprietaire">Propriétaire</label><input type="text" name="proprietaire" id="proprietaire" /></p>
				<p><label for="x">X</label><input type="text" name="x" id="x" /></p>
				<p><label for="y">Y</label><input type="text" name="y" id="y" /></p>
				<p><label for="pt">PT</label>
					<select name="pt" id="pt">
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
						<option value="13">13</option>
						<option value="14">14</option>
						<option value="15">15</option>
						<option value="16">16</option>
						<option value="17">17</option>
						<option value="18">18</option>
						<option value="19">19</option>
						<option value="20">20</option>
					</select>
				</p>
				<p><label for="bottes">Bottes</label>
					<select name="bottes" id="bottes">
						<option value="aucune">Aucune</option>
						<option value="mercenaire">Bottes du mercenaire</option>
						<option value="guerrier">Bottes du guerrier</option>
						<option value="archer">Bottes de l'archer</option>
					</select>
				</p>
				<p><label for="cible">Peut viser</label>
					<select name="cible" id="cible">
						<option value="unique">Unique</option>
						<option value="majeur">Majeur</option>
						<option value="mineur">Mineur</option>
						<option value="tournante">Tournante</option>
					</select>
				</p>
				<p><label for="cdt">CDT</label>
					<select name="cdt" id="cdt">
						<option value="0">0</option>
						<option value="10">10</option>
						<option value="20">20</option>
					</select>
				</p>

				<p><label for="valider">&nbsp;</label><input type="submit" id="valider" value="Valider" /></p>
			</form>
		</div>

		<script>
		$("tbody").scroll(function(){
			$("tbody").scrollTop($(this).scrollTop());    
		})
		</script>
	</div>

	<div class="conteneur_clear"></div>
</div>
