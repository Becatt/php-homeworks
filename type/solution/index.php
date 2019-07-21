<?php

//Задание 1

$continents = [
    'Africa' => ['Mammuthus columbi', 'Cephalophinae', 'Okapia johnstoni'],
	'Australis' => ['Thylacinus cynocephalus', 'Vombatidae', 'Macropus agilis', 'Sarcophilus harrisii'],
	'Antarctica' => ['Cryolophosaurus', 'Aptenodytes forsteri'], 
	'Eurasia' => ['Ursus arctos', 'Canis lupus', 'Sciurus'],
	'North America' => ['Rangifer tarandus', 'Mephitidae', 'Castor fiber'],
	'South America' => ['Leopardus pardalis', 'Puma', 'Battus polydamas antiquus']
];

//задание 2

foreach ($continents as $continent => $animals) {

	foreach ($animals as $animal) {

		if (substr_count($animal, " ") == 1) {
		$animalsNames [] = $animal;
        }  
	}
}

//Здание 3
	
foreach ($animalsNames as $animal) {
    $animalArr = explode(' ', $animal);    
    $firstWord [] = $animalArr [0];
    $secondWord [] = $animalArr [1];
}


shuffle($firstWord);  
shuffle($secondWord);

    
for ($i = 0; $i < count($firstWord); $i++) {
    $newAnimals [] = $firstWord [$i] . ' ' . $secondWord [$i];
}

echo implode(', ', $newAnimals) , '.';

?>