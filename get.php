<?php
    require_once "vendor/autoload.php";
    use wsTest\Error;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
    use PhpOffice\PhpSpreadsheet\Cell\Cell;
    use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

    Error::init();

    $query = "SELECT 
                    wst_answer.id, 
                    wst_distinct.`distinct`, 
                    wst_school.school,
                    wst_answer.class,
                    wst_answer.c1,	wst_answer.c2,	wst_answer.c3,	wst_answer.c4, 	wst_answer.c5,
                    wst_answer.c6, 	wst_answer.c7, 	wst_answer.c8,	wst_answer.c9,	wst_answer.c10,
                    wst_answer.c11, 	wst_answer.c12,	wst_answer.c13,	wst_answer.c14,	wst_answer.c15
                FROM wst_answer, wst_distinct, wst_school
                WHERE
                    wst_distinct.id = wst_answer.regionrm AND
                    wst_school.region = wst_distinct.id AND
                    wst_school.id = wst_answer.school
                ORDER BY wst_answer.id";
    $query = \QB::query($query);


    $result = $query->get();

$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
$reader->setReadDataOnly(false);
$spreadsheet = $reader->load('tmpl.xlsx');
$workSheet = $spreadsheet->getActiveSheet();

$truth = array(0,5,5,5,8,5,8,8,4,5,7,7,5,5,6,5);//Кол-во ответов для категории
$tm =    array(0,2,1,2,2,3,1,2,2,4,1,3,2,3,3,4);//маршруты для категорий
$marshrut = array(0 =>'Интересы не выявлены',1 => 'Креативные профессии, цифровые технологии и образование', 2 =>'Производство, инженерия и безопасность', 3=>'Сфера услуг', 4=>'Строительные технологии');
$tmpar = array();
(int)$x = 1;//стартовый столбец
(int)$y = 2;//стартовая строка

foreach ($result as $v) { //все строки из базы
    Error::pdump('x-'.$x);
    $workSheet->setCellValueByColumnAndRow($x++, $y, $v->id);
    $workSheet->setCellValueByColumnAndRow($x++, $y, $v->distinct);
    $workSheet->setCellValueByColumnAndRow($x++, $y, $v->school);
    $workSheet->setCellValueByColumnAndRow($x++, $y, $v->class);
    $tmpar = array_fill(1, 15, 0);
    for ($i = 1, $max = 1; $i < 16; $i++){
        $c = 'c'.$i;
        $workSheet->setCellValueByColumnAndRow($x++, $y, $v->$c);
        $tmpar[$i] = (int)$v->$c;//количество ответов по категориям
        if ($tmpar[$i] >= $truth[$i] && $tmpar[$i] >$tmpar[$max])
            $max = $i;
    }
    if ($tmpar[$max] >= $truth[$max]){
        $workSheet->setCellValueByColumnAndRow($x, $y, 'Маршрут '.$tm[$max].': '.$marshrut[$tm[$max]]);
    } else {
        $workSheet->setCellValueByColumnAndRow($x, $y, $marshrut[0]);
    }
    $max = 1;
    $x = 1;
    $y++;
}

$writer = new Xlsx($spreadsheet);
$writer->setPreCalculateFormulas(false);
$output = 'php://output';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Данные теста.xlsx"');
header('Cache-Control: max-age=0');
$writer->save($output);
exit();