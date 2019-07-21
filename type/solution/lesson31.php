<?php
//задание 1
$continents = [
	'Africa' => ['Mammuthus columbi', 'Cephalophinae', 'Okapia johnstoni'],
	'Australis' => ['Thylacinus cynocephalus', 'Vombatidae', 'Macropus agilis', 'Sarcophilus harrisii'],
	'Antarctica' => ['Cryolophosaurus', 'Aptenodytes forsteri'], 
	'Eurasia' => ['Ursus arctos', 'Canis lupus', 'Sciurus'],
	'North America' => ['Rangifer tarandus', 'Mephitidae', 'Castor fiber'],
	'South America' => ['Leopardus pardalis', 'Puma']
];

//задание 2
foreach ($continents as $continent => $animals) {
	//echo '<b>' . $continent, '</b><br>';
	$selectedAnimals [$continent];

	foreach ($animals as $key => $animal) {
		
		$result = strpos($animal, " ");
		if ($result != null) {
			$animalsNames [] = $animal;
		}

	}
  
      $selectedAnimals [$continent] = $animalsNames;
      unset($animalsNames);
}

//Здание 3

foreach ($selectedAnimals as $continent => $animals) {
	
  foreach ($animals as $key => $animal) {
    $animalArr = explode(' ', $animal);    
    $firstWord [] = $animalArr [0];
    $secondWord [] = $animalArr [1];

    }
    
    shuffle($firstWord);
    shuffle($secondWord);

    for ($i = 0; $i < count($animals); $i++) {
    $newAnimals [] = $firstWord [$i] ." ". $secondWord [$i];
    }

    $selectedAnimals [$continent] = $newAnimals;
     unset ($firstWord);
     unset ($secondWord);
     unset($newAnimals);        
}


foreach
  
  ($selectedAnimals as $continent => $animals) {
	echo '<h1>' . $continent, '</h1><br>';
    echo implode(', ', $animals) , '.';
}

?>