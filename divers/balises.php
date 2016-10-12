<?php

function attrs($attributes) {
	$opt = ""; // Au départ j'ai la chainevide
	foreach($attributes as $attr=>$val) {
		$opt = $opt." $attr='$val'"; // Couple attribut/valeur ajoutée à la chaine
	}
	return $opt;
}


// Les liens

function lien($url,$texte,$attributes = array()) {
	$opt = attrs($attributes);
	return "<a href='$url'$opt>$texte</a>";
}

//Les items

function item($contenu,$attributes = array()) {
	$opt = attrs($attributes);
	return "<li $opt>$contenu</li>";
}


// Le contenu d'une table


function table($tableDim2) {
	$tmp = "";
	foreach($tableDim2 as $ligne) {
		$tmp = $tmp . "<tr>";
		foreach($ligne as $cellule)
			$tmp = $tmp."<td>$cellule</td>";

		$tmp = $tmp . "</tr>";

	}
	return $tmp;

}

function input($type,$name,$attributes = array()) {
	$opt = attrs($attributes);
	return "<input type='$type' name='$name' $opt />";
}

function select($name,$tabValeurs) {
	$tmp ="";
	foreach($tabValeurs as $ret=>$val) {
		$tmp = $tmp. "<option value='$ret'>$val</option>\n";
	}

	return "<select name='$name'>$tmp</select>";
}

?>