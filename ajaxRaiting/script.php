<?php
require_once ("phpExcel/Classes/PHPExcel.php");
require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';

$months = Array(
    "Января" => "01",
    "Февраля" => "02",
    "Марта" => "03",
    "Апреля" => "04",
    "Мая" => "05",
    "Июня" => "06",
    "Июля" => "07",
    "Августа" => "08",
    "Сентября" => "09",
    "Октября" => "10",
    "Ноября" => "11",
    "Декабря" => "12"
);

$id = $_POST["id"];
$count = $_POST["count"];

$url = "http://firrma.ru/data/news/" . $id . "/";
$html = htmlString($url);



if (preg_match('/meta property="og:url" content="http:\/\/firrma.ru\/data\/news/', $html) == true) {
    $allInfo['date1'] = takeDate($html, $months);
    $allInfo['url1'] = $url;
    $allInfo['header1'] = takeHeader($html);
    $allInfo['content1'] = takeContent($html);

    $phpExcel = PHPExcel_IOFactory::createReader('Excel2007');
    $phpExcel = $phpExcel->load('test.xlsx');
    $phpExcel->setActiveSheetIndex(0);
    $phpExcel->getActiveSheet()->setCellValue('A' . $count, $allInfo['date1']);
    $phpExcel->getActiveSheet()->setCellValue('B' . $count, $allInfo['url1']);
    $phpExcel->getActiveSheet()->setCellValue('C' . $count, $allInfo['header1']);
    $phpExcel->getActiveSheet()->setCellValue('D' . $count, $allInfo['content1']);

    $Zapisat = PHPExcel_IOFactory::createWriter($phpExcel, 'Excel2007');
    $Zapisat->save('test.xlsx');

}

if (empty($allInfo['date1']))
    echo "0";
else
    echo $allInfo['date1'];




function htmlString($url){
    $line = file($url);
    $html = implode("", $line);
    $html = iconv("windows-1251", "utf-8", $html);
    return $html;
}

function takeDate($html, $months){
    if ($html[strripos($html, 'class="date"') + 19] != " ")
        $date = mb_strcut($html, strripos($html, 'class="date"') + 18, 24, 'UTF-8');
    else
        $date = mb_strcut($html, strripos($html, 'class="date"') + 18, 23, 'UTF-8');
    $dateExplode = explode(" ", $date);
    if (iconv_strlen($dateExplode[0]) == 1)
        $dateExplode[0] = "0" . $dateExplode[0];

    $date = $dateExplode[2] . "." . $months[$dateExplode[1]] . "." . $dateExplode[0];
    return $date;
}

function takeHeader($html){
    mb_regex_encoding("UTF-8");
    mb_ereg_search_init($html, 'class="text".*');
    $header = mb_ereg_search_regs();
    $index2 = mb_strpos($header[0], '<');

    $header = mb_strcut($header[0], 13, $index2-13);
    return $header;
}

function takeContent($html){
    mb_regex_encoding("UTF-8");
    mb_ereg_search_init($html, 'class="news-text".*');
    $content = mb_ereg_search_regs();
    $index2 = mb_strpos($content[0], 'news-likes');
    $content = mb_strcut($content[0], 18, $index2);
    $content = strip_tags($content);
    $content = str_replace("\n", "", $content);
    $content = str_replace("\r", " ", $content);
    $content = str_replace("&laquo;", " ", $content);
    $content = str_replace("&raquo;", " ", $content);
    $content = str_replace("&mdash;", " ", $content);
    return $content;
}
?>