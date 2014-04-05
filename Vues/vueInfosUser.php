<?php $this->titre="Vos informations"; ?>
<div id="bloc_contents">
<h3 id="titrePage"> Mes informations </h3>
	<span class="label_infos">Pseudo :</span><?php echo $utilisateur->getPseudo();?>
	<br/>
	<br/>
	<span class="label_infos">Nom :</span><?php echo $utilisateur->getNom();?>
	<br/>
	<br/>
	<span class="label_infos">Prenom :</span><?php echo $utilisateur->getPrenom();?>
	<br/>
	<br/>
	<span class="label_infos">Adresse mail :</span><?php echo $utilisateur->getEmail();?>
	<br/>
	<br/>
	<span class="label_infos">Date D'incription :</span><?php echo $utilisateur->getDateInscription();?>
</div>
