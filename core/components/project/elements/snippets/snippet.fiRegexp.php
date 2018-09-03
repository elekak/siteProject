<?php
/**
 * Альтернатива стандартному валидатору regexp formit (родной валидатор режет важные символы)
 *
 * @var string $key
 * @var string $value
 * @var string $param
 * @var string $type
 * @var fiValidator $validator
 */

$formit = &$validator->formit;

//Из-за того, что перед обработкой formit вырезает символ ^, возьмем этот параметр из конфига
$validateParam = $formit->config['validate'];
$validatePieces = explode(',',$validateParam);
$paramFound = false;
$expression = '';
foreach($validatePieces as $validatePiece){
    $validatePiecePieces = explode(':',$validatePiece);
    $validateField = $validatePiecePieces[0];
    if($validateField != $key) continue;

    //Вот здесь мы и выцепляем нужный нам параметр
    for($i = 1; $i < count($validatePiecePieces); $i++){
        list($validatorName,$validatorParam) = explode('=',$validatePiecePieces[$i]);
        if($validatorName == $type){
            $expression = $validatorParam;
            $paramFound = true;
            break 2;
        }
    }
}

if(!$paramFound){
    $validator->addError($key, 'Не указано регуляртное выражение для fiRegexp');
    return false;
}

if(!preg_match($expression,$value)){
    $message = $formit->config[$key.'.fiRegexpMessage'];
    if(!$message){
        $message = 'Укажите '.$key.' в соответствии с форматом';
    }
    $validator->addError($key, $message);
    return false;
}

return true;