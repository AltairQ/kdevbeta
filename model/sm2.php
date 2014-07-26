<?php

function newEF($EF, $q)
{
	$nEF= $EF - 0.8 + 0.28*$q - 0.02*$q*$q;
	if ($nEF < 1.3) {
		$nEF = 1.3;
	}

	return $nEF;
}

function newI($i, $EF, $rno)
{
	if ($rno == 1) {
		return 1;
	}

	if ($rno == 2) {
		return 6; //hym hym hym cośtam potem pogrzebiemy jak to za dużo
	}

	return $i*$EF;
}


?>
