<?php 
function parseDate($date, $month=NULL)
    {
        $d = date('d', strtotime($date));
        $y = date('Y', strtotime($date));
        $h = date('H:i', strtotime($date));
        if(!$month) {
            $month = date('m', strtotime($date));
        }
        switch($month){
            case '1':
                $m[0] = 'JAN';
                $m[1] = 'Janeiro';
                break;
            case '2':
                $m[0] = 'FEV';
                $m[1] = 'Fevereiro';
                break;
            case '3':
                $m[0] = 'MAR';
                $m[1] = 'Março';
                break;
            case '4':
                $m[0] = 'ABR';
                $m[1] = 'Abril';
                break;
            case '5':
                $m[0] = 'MAI';
                $m[1] = 'Maio';
                break;
            case '6':
                $m[0] = 'JUN';
                $m[1] = 'Junho';
                break;
            case '7':
                $m[0] = 'JUL';
                $m[1] = 'Julho';
                break;
            case '8':
                $m[0] = 'AGO';
                $m[1] = 'Agosto';
                break;
            case '9':
                $m[0] = 'SET';
                $m[1] = 'Setembro';
                break;
            case '10':
                $m[0] = 'OUT';
                $m[1] = 'Outubro';
                break;
            case '11':
                $m[0] = 'NOV';
                $m[1] = 'Novembro';
                break;
            case '12':
                $m[0] = 'DEZ';
                $m[1] = 'Dezembro';
                break;
        }
        $dateArray['short'] = $d.' '.$m[0].' '.$y;
        $dateArray['long'] = $d.' de '.$m[1].' de '.$y;
        $dateArray['day'] = $d;
        $dateArray['month'] = $m[1];
        $dateArray['year'] = $y;
        $dateArray['hour'] = $h;
        $dateObj = (object)$dateArray;
        return $dateObj;
    }
?>