<?php

//Задание 1

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

//Здание 3 + доп.

foreach ($selectedAnimals as $continent => $animals) {
	
    foreach ($animals as $key => $animal) {
        $animalArr = explode(' ', $animal);    
        $firstWord [] = $animalArr [0];
        $secondWord [] = $animalArr [1];

    }
    
    shuffle($firstWord);

    for ($i = 0; $i < count($animals); $i++) {
        $newAnimals [] = $firstWord [$i];
    }

    $selectedAnimals [$continent] = $newAnimals;
    unset ($firstWord);
    unset($newAnimals);        
}
   
shuffle($secondWord);

foreach ($selectedAnimals as $continent => $animals) {
    
    echo '<h1>' . $continent, '</h1><br>';
    
    for ($i = 0; $i < count($animals); $i++) {
        $newAnimals [] = $animals [$i] . ' ' . array_shift($secondWord);
    }

    echo implode(', ', $newAnimals) , '.';
    unset($newAnimals);
}

?>