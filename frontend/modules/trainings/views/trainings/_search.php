<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\trainings\models\TrainingsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trainings-search">

    <?php
    $month[1] = "Январ";
    $month[2] = "Феврал";
    $month[3] = "Март";
    $month[4] = "Апрел";
    $month[5] = "Ма";
    $month[6] = "Июн";
    $month[7] = "Июл";
    $month[8] = "Август";
    $month[9] = "Сентябр";
    $month[10] = "Октябр";
    $month[11] = "Декабр";
    $month[12] = "Январ";

    $day[0] = "Воскресенье";
    $day[1] = "Понедельник";
    $day[2] = "Вторник";
    $day[3] = "Среда";
    $day[4] = "Четверг";
    $day[5] = "Пятница";
    $day[6] = "Суббота";

    $dnum = date("w");
    $mnum = date("n");
    $daym = date("d");
    $year = date("Y");

    $textday = $day[$dnum];
    $monthm = $month[$mnum];

    if ($mnum == 3 || $mnum == 8) {
        $k = "а";
    } else {
        $k = "я";
    }

    // echo "Сегодня:  $textday, $daym $monthm$k $year г.";

    function dates_month($pd, $year) {

        $frm = explode(".", $pd);
        $month = $frm[1];
        $year = $frm[2];

        $day[0] = "ВС";
        $day[1] = "ПН";
        $day[2] = "ВТ";
        $day[3] = "СР";
        $day[4] = "ЧТ";
        $day[5] = "ПТ";
        $day[6] = "СБ";

        $month_['01'] = "Январь";
        $month_['02'] = "Февраль";
        $month_['03'] = "Март";
        $month_['04'] = "Апрель";
        $month_['05'] = "Май";
        $month_['06'] = "Июнь";
        $month_['07'] = "Июль";
        $month_['08'] = "Август";
        $month_['09'] = "Сентябрь";
        $month_['10'] = "Октябрь";
        $month_['11'] = "Ноябрь";
        $month_['12'] = "Декабрь";

        $monthm = $month_[$month];

        ## date modify +1 month
        $date = $pd;
        $date = new DateTime($date);
        $date_next = $date->modify('+1 month');
        //$date_next = $date->format('01.m.Y');

        if ($date->format('d.m.Y') == date('01.m.Y')) {
            $dayr = date('d');
            $date_next = $date->format($dayr . '.m.Y');
        } else {
            $date_next = $date->format('01.m.Y');
        }

        ## date modify -1 month
        $date_mod = '01.' . $month . '.' . $year;
        $date = new DateTime($date_mod);
        $date->sub(new DateInterval('P1M'));
        $date_prev = $date->format('01.m.Y');
        ?>
        <h4 class="dateline center">
            <?php
            echo "<a class='dateline_prev left' href='?date=" . $date_prev . "'>"
            . "<i class='icon-chevron-left'></i></a>";
            echo '<span class="">' . $monthm . ', ' . date('Y') . '</span>';
            echo "<a class='dateline_next right' href='?date=" . $date_next . "'> "
            . "<i class='icon-chevron-right'></i></a>";
            echo '<br>';
            ?>
        </h4>
        <?php
        // дней в месяце
        $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $dates_month = array();
        echo '<div class="dateline_day">';
        for ($i = 1; $i <= $num; $i++) {
            $mktime = mktime(0, 0, 0, $month, $i, $year);
            $dnum = date("w", $mktime);
            $textday = $day[$dnum];
            // echo $textday . ' ';
        }
        echo '</div>';
        echo '<div class="dateline_numbers">';
        for ($i = 1; $i <= $num; $i++) {
            $mktime = mktime(0, 0, 0, $month, $i, $year);
            $date = date("d", $mktime);
            $datem = date("d.m.Y", $mktime);
            $dt = Yii::$app->formatter->asTimestamp($datem);

            $dnum = date("w", $mktime);
            $textday = $day[$dnum];

            $fin = app\modules\trainings\models\Trainings::findOne(['date' => $dt, 'status_id' => 1]);
            echo '<div class="left dateline_number-' . $num . ' ">' . $textday . '<hr class="null">';
            if ($fin != NULL) {
                echo '<span>' . Html::a($date, ['', 'date' => $datem]) . '</span>';
            } else {
                echo '<span>' . $date . '</span>';
            }
            $dates_month[$i] = $date;
            echo '</div>';
        }
        echo '</div>';
        //return $dates_month;
    }

    $yget = \Yii::$app->request->get();
    if ($yget) {
        $get = (empty($yget)) ? NULL : $yget;
        $pd = $get['date'];
    } else {
        $pd = date('d.m.Y');
    }
    dates_month($pd, date('Y'));
    ?>  

</div>
<?php
/**
 * Вывод календаря
 */
$yget = \Yii::$app->request->get();
$get = (empty($yget)) ? NULL : $yget;
$pd = $get['date'];

$month = explode(".", $pd);

if (!$pd) {
    if (Yii::$app->request->get() && $month[1] != date('m')) {
        $this->registerJs(setDate(1));
    } else {
        $this->registerJs(setDate(date('d'), date('d')));
    }
} else {
    if (Yii::$app->request->get() && $month[1] != date('m')) {
        $dater = explode(".", $pd);
        $this->registerJs(setDate($dater[0]));
    } else {
        $dater = explode(".", $pd);
        $this->registerJs(setDate($dater[0], date('d')));
    }
}

function setDate($date, $x = 'not') {
    for ($i = 0; $i < 7; $i++) {
        $date_inc = $date + $i;
        $arr[$i] = str_pad($date_inc, 2, '0', STR_PAD_LEFT);
    }
    return $style = ''
            . '$(".dateline_numbers div span:contains(' . $x . ')").addClass("dateline_d_0");'
            . '$(".dateline_numbers div span:contains(' . $arr[0] . ')").addClass("dateline_d_1");'
            . '$(".dateline_numbers div span:contains(' . $arr[1] . ')").addClass("dateline_d");'
            . '$(".dateline_numbers div span:contains(' . $arr[2] . ')").addClass("dateline_d");'
            . '$(".dateline_numbers div span:contains(' . $arr[3] . ')").addClass("dateline_d");'
            . '$(".dateline_numbers div span:contains(' . $arr[4] . ')").addClass("dateline_d");'
            . '$(".dateline_numbers div span:contains(' . $arr[5] . ')").addClass("dateline_d");'
            . '$(".dateline_numbers div span:contains(' . $arr[6] . ')").addClass("dateline_d dateline_d_l");'
            . '';
}
