<?php    
 
	$data = file_get_contents('php://input');
	if($data != null){
		$dataJSON = json_decode($data);
		for($i=0; $i < count($dataJSON); $i++){
			if($dataJSON[$i]->{'target'} == true){
				$targetID = $i;
			}
		}
		$xml = simplexml_load_file("game.xml");
		$levels = $xml->levels;
		$level = $levels->addChild('level');
		$level->addChild('id', (count($levels->children())));
		$blocks = $level->addChild('blocks');
		$target = $blocks->addChild('target');
		$targetOrigin = $target->addChild('origin');
		$targetOrigin->addChild('x', (($dataJSON[$targetID]->{'origin'}->{'x'} / 100)));
		$targetOrigin->addChild('y', (($dataJSON[$targetID]->{'origin'}->{'y'} / 100)));
		$targetSize = $target->addChild('size');
		$targetSize->addChild('x', 2);
		$targetSize->addChild('y', 1);
    $level->addChild('valid_for_divisions', '6');
    $level->addChild('level_of_difficulty', '1');
		for($i=0; $i < count($dataJSON); $i++){
			if($dataJSON[$i]->{'target'} == false){
				$block = $blocks->addChild('block');
				$blockOrigin = $block->addChild('origin');
				$blockOrigin->addChild('x', ($dataJSON[$i]->{'origin'}->{'x'} / 100));
				$blockOrigin->addChild('y', ($dataJSON[$i]->{'origin'}->{'y'} / 100));
				$blockSize = $block->addChild('size');
				$blockSize->addChild('x', $dataJSON[$i]->{'x'});
				$blockSize->addChild('y', $dataJSON[$i]->{'y'});
			}
		}
		$xml->asXML("game.xml");
	}

?>
