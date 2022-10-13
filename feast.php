<?php
$animalList = "ant bird cat chicken cow dog elephant fish fox horse kangaroo lion monkey penguin pig rabbit sheep tiger whale wolf";
$animalsArray = explode(" ", $animalList);
$animalsArrays = array_chunk($animalsArray,count($animalsArray)/20,true);
$dishList = "sushi ramen kebab paella steak pie goulash lasagna kimchi pizza hamburger donuts";
$dishArray = explode(" ", $dishList);
$dishArrays = array_chunk($dishArray,count($dishArray)/12,true);

$animalFunc = function($animalsArrays){
foreach($animalsArrays as $key=> $value){
    return $value[0];
    
}
};
$dishFunc = function($dishArray){
    foreach($dishArray as $key=> $value){
        return $value[0];
        
    }
    };
$animalsFirstLetter = array_map($animalFunc,$animalsArrays);
$dishFirstLetter = array_map($dishFunc,$dishArrays);

$inArray=function($dishArrays){
    if(in_array("sushi",$dishArrays)){
    return "true";
}
};
    
print_r($inArray);