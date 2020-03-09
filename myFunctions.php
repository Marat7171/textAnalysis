<?php

// Преобразование по формату utf-8
function formatConversion($file_dir) {
	$t = file_get_contents($file_dir);
	$get  = mb_detect_encoding($t, array('utf-8', 'cp1251'));
	$textf = iconv($get,'UTF-8',$t);
	return $textf;
}

// Функция,которая принимает текст и возвращает массив(ключ=>слово, значение=>количество вхождений + всего слов) 
function analysis($randText) {
	$textLover = mb_strtolower($randText);
	$finishedText = str_replace(['!', '?', ':', ',', '.'], "", $textLover);	
	$arrayFT = explode(' ', $finishedText);
	$count = count($arrayFT);
	$array0 = [];
	foreach ($arrayFT as $word) {
		if (isset($array0[$word])) {
			$array0[$word]++;
		} else {
			$array0[$word] = 1;
		}
	}
	$array0['Всего слов'] = $count;
	return $array0;
}

// запись обработанного файла
function fileRecord($time0, $text0) {
	$file = fopen("result/{$time0}.csv", "w");
	foreach (analysis($text0) as $a => $b) {
		fwrite($file, "{$a}: {$b}" . PHP_EOL);
	}
	fclose($file);
}

function wordFun($pdo0, $text0, $time0) {
	$sql = 'INSERT INTO word(text_id, word, count) VALUES (:text_id, :word, :count)';
	$params = $pdo0->prepare($sql);
	foreach (analysis($text0) as $a => $b) {
		if (!($a === 'Всего слов')) {
			$params->execute(['text_id' => $time0, 'word' => $a, 'count' => $b]);
		}
	}
}

function uploadedTextFun($pdo0, $text0, $time0) {
	$sqlt = 'INSERT INTO uploaded_text(id, content, date, words_count) VALUES (:id, :content, :date, :words_count)';
	$paramst = $pdo0->prepare($sqlt);
	$paramst->execute(['id' => $time0, 'content' => $text0, 'date' => $time0, 'words_count' => array_pop(analysis($text0))]);
}

function textOutput($pdo0, $id_db0) {
	$selectQuery = "SELECT * FROM `uploaded_text` WHERE `id` = {$id_db0}";
	$row = $pdo0->query($selectQuery)->fetch(PDO::FETCH_ASSOC);
	echo $row['content'] . ' / ' . date('l jS \of F Y h:i:s A', $row['date']) . ' / ' . $row['words_count'];
}

function wordOutput($pdo0, $id_db0) {
	$selectQueryw = "SELECT * FROM `word` WHERE `text_id` = {$id_db0}"; 
	$roww = $pdo0->query($selectQueryw)->fetchall(PDO::FETCH_ASSOC);
	foreach ($roww as $a => $b) {
		echo "Слово: " . '"' . $b['word'] . '"' . " Количество вхождений: " . $b['count'] . "<br>"; 
	}
}

function homePageDatabaseHandler($pdo0) {
	$selectQuery = 'SELECT * FROM `uploaded_text` ORDER BY `id` DESC';
	$query = $pdo0->query($selectQuery);
	$row = $query->fetchall(PDO::FETCH_ASSOC);
	return $row;
}
function outputToTheMainScreen($b0) {
	echo $b0['id'] . " / " . substr($b0['content'], 0, 30) . '...' . " / " . date('l jS \of F Y h:i:s A', $b0['date']) . " / " . $b0['words_count']; 
}

