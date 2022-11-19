<?php
// --------------------------
// -------------- Pokemon
// --------------------------


// --------------------------
// -------------- Month array
// --------------------------
$months = [
    "Janvier",
    "Février",
    "Mars",
    "Avril",
    "Mai",
    "Juin",
    "Juillet",
    "Août",
    "Septembre",
    "Octobre",
    "Novembre",
    "Décembre",
];


// ---------------------------------------
// -------------- Stockage valeur post
// ---------------------------------------
//  MONTH ou currentmonth par défault
$currentmonth = date("n");
$datemonth = ($_GET['month']) ?? $currentmonth;

// Récuparation valeur post YEAR ou currentyear par défault
$currentyear = date("Y");
$dateyear = ($_GET['year']) ?? $currentyear;

// Input mois +1 / -1
$previousmonth = $datemonth - 1;
$nextmonth = $datemonth + 1;
// Input year +1 / -1
$previousyear = $dateyear;
$nextyear = $dateyear;


// ---------------------------------------------------------------------------------------
// -------------- Controle month boutton previous / next month & control month > 12 & < 1
// ---------------------------------------------------------------------------------------
if ($datemonth == 12) {
    $previousyear = $dateyear;
    $nextyear = $dateyear + 1;
    $previousmonth = 11;
    $nextmonth = 1;
} else if ($datemonth == 1) {
    $previousyear = $dateyear - 1;
    $nextyear = $dateyear;
    $previousmonth = 12;
    $nextmonth = 2;
}


// ----------------------------------------------------
// -------------- Jour des mois Courant / Avant / Aprés
// ----------------------------------------------------
// Nombre de jours du mois courant
$nbdays = cal_days_in_month(CAL_GREGORIAN, $datemonth, $dateyear);
// Nombre de jours du mois d'avant
// ----------------------------------------------------------------------------------
$nbdayspreviousmonth = cal_days_in_month(CAL_GREGORIAN, $previousmonth, $dateyear);

// Title calendar
$displaydatemonth = ($datemonth < 10) ? "0$datemonth" : "$datemonth";
$titledate =  "$displaydatemonth / $dateyear";


// --------------------------------------------------------
// -------------- First day of month
// -------------------------------------------------------
$dayofmonth = date('N', strtotime("$dateyear-$datemonth"));
$nbdaysbefore = ($dayofmonth - 1);

// -----------------------------------------------------------
// -------------- Calcul nombre de jours du mois du calendrier
// -----------------------------------------------------------
$dayscalendar = 42 - $nbdaysbefore;
$nbdaysafter = 42 - ($nbdays + $nbdaysbefore);


// ----------------------------------------------------------------------------------
$test = $nbdayspreviousmonth - $nbdaysbefore;
// ----------------------------------------------------------------------------------
// -------------------------------------
// -------------- HTML
// -------------------------------------
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier</title>
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>

<body>
    <div class="bg-calendar">
        <!------------- HEADER ------------->
        <div class="header-calendar">
            <div>
                <h1>Calendrier</h1>
                <h2><?= $titledate ?></h2>
            </div>
            <!------------- SELECT DATE ------------->
            <div class="select-date">
                <h3>selectionner une date : </h3>
                <form action="index.php" method="GET">
                    <!-- select Month -->
                    <select name="month" id="month">
                        <?php
                        foreach ($months as $key => $month) {
                            $value = $key + 1;
                            $isSelected = ($datemonth == $value) ? 'selected' : '';
                            echo "<option $isSelected value=\"$value\" >$month</option>";
                        }
                        ?>
                    </select>
                    <!-- select YEAR -->
                    <select name="year" id="year">
                        <!-- BOUCLE NB YEAR -->
                        <?php
                        for ($i = 2015; $i <= 2042; $i++) {
                            $isSelected = ($dateyear == $i) ? 'selected' : '';
                            echo "<option $isSelected value= $i >$i</option>";
                        }
                        ?>
                    </select>
                    <input type="submit" value="Afficher">
                </form>
            </div>
        </div>
        <!------------- CALENDAR  ------------->
        <section class="calendar">
            <!-- boutton month - 1 -->
            <div class="before">
                <a href=<?= "http://localhost/calendar/index.php?month=$previousmonth&year=$previousyear" ?> id="btn-before">
                    <i class="fa-solid fa-angle-left"></i>
                </a>
            </div>
            <div>
                <div class="calendar-days">
                    <!------------- CALENDAR DAYS ------------->
                    <div class="day"><span>Lundi</span></div>
                    <div class="day"><span>Mardi</span></div>
                    <div class="day"><span>Mercredi</span></div>
                    <div class="day"><span>Jeudi</span></div>
                    <div class="day"><span>Vendredi</span></div>
                    <div class="day"><span>Samedi</span></div>
                    <div class="day"><span>Dimanche</span></div>
                </div>
                <div class="calendar-body">
                    <!------------- DISPLAY CALENDAR DAYS ------------->
                    <!-- Jour du mois d'avant -->
                    <?php
                    for ($i = $test + 1; $i <= $nbdaysbefore + $test; $i++) {
                        echo "<div class=\"box-day box-day-empty\"><span class=\"number-day\"> $i </span></div>";
                    }
                    for ($i = 1; $i <=  $nbdays; $i++) {
                        echo "<div class=\"box-day\"><span class=\"number-day\"> $i </span></div>";
                    }
                    for ($i = 1; $i <= $nbdaysafter; $i++) {
                        echo "<div class=\"box-day box-day-empty\"><span class=\"number-day\"> $i </span></div>";
                    }
                    ?>
                </div>
            </div>
            <!-- boutton month + 1 -->
            <div class="after">
                <a href=<?= "http://localhost/calendar/index.php?month=$nextmonth&year=$nextyear" ?> id="btn-after">
                    <i class="fa-solid fa-angle-right"></i>
                </a>
            </div>
        </section>
    </div>
</body>

</html>