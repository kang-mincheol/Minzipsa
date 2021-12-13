<?

header("Content-Type: text; charset=UTF-8");
?>

<?

echo getCalculateDate("20191130", "익익월7일");

function getCalculateDate($stdDate, $settlePeriodCd){
    $date=date_create($stdDate);
    
    if($settlePeriodCd == "익익익주수요일" || $settlePeriodCd == "익익주수요일"){
        if($settlePeriodCd == "익익익주수요일"){
            date_add($date,date_interval_create_from_date_string("21 days"));
        }
        else if($settlePeriodCd == "익익주수요일"){
            date_add($date,date_interval_create_from_date_string("14 days"));
        }
        
        
        switch(date_format($date,"w")){
            case 0:
                date_add($date,date_interval_create_from_date_string("-4 days"));
            break;
            case 1:
                date_add($date,date_interval_create_from_date_string("+2 days"));
            break;
            case 2:
                date_add($date,date_interval_create_from_date_string("+1 days"));
            break;
            case 3:
            break;
            case 4:
                date_add($date,date_interval_create_from_date_string("-1 days"));
            break;
            case 5:
                date_add($date,date_interval_create_from_date_string("-2 days"));
            break;
            case 6:
                date_add($date,date_interval_create_from_date_string("-3 days"));
            break;
        }
    }
    else if ($settlePeriodCd == "익익월7일"){
        date_add($date,date_interval_create_from_date_string("2 months"));
        $date=date_create(date_format($date,"Y-m-07"));
    }
    
    
    
    return date_format($date,"Y-m-d");
}




//echo $html;

?>