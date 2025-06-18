<?php
require_once __DIR__ . '/classMakeTime.php';
require_once __DIR__ . '/classForStyles.php';
class Calendar
{
    private MakeTime $time;

    public function __construct()
    {
        global $defaultZone;
        $this->time = new MakeTime();
        $this->time->defaultZone = date_default_timezone_set($defaultZone);
        echo CalendarStyles::calendarStyle();
    }

    public function navigation()
    {

        // Array para traducír e incorporar el nombre de los meses.
        $monthNames = [
            'Enero',
            'Febrero',
            'Marzo',
            'Abril',
            'Mayo',
            'Junio',
            'Julio',
            'Agosto',
            'Septiembre',
            'Octubre',
            'Noviembre',
            'Diciembre'
        ];

        $siblingsMonths = $this->time->month;
        $years = $this->time->year;

        if ($siblingsMonths < 1) {
            $siblingsMonths = 12;
            $years--;
        } elseif ($siblingsMonths > 12) {
            $siblingsMonths = 1;
            $years++;
        }

        $prevMonth = $siblingsMonths - 1;
        $nextMonth = $siblingsMonths + 1;
        $prevYear = $years;
        $nextYear = $years;
        if ($prevMonth < 1) {
            $prevMonth = 12;
            $prevYear--;
        }
        if ($nextMonth > 12) {
            $nextMonth = 1;
            $nextYear++;
        }

        $currentName = $monthNames[$siblingsMonths - 1] . " $years";
        $prevLink = "?month=$prevMonth&year=$prevYear";
        $nextLink = "?month=$nextMonth&year=$nextYear";
        ?>
        <a href="<?php echo $prevLink; ?>">&laquo;</a>
        <strong><?php echo $currentName; ?></strong></strong>
        <a href="<?php echo $nextLink; ?>">&raquo;</a>
        <?php
    }

    public function calendar()
    {
        /* $months = $this->time->month;
        $years = $this->time->year; */
        $dayOfMonth = $this->time->monthDays;
        $isToday = $this->time->today;
        $firstDay = $this->time->firstDayMonth;


        ?>
        <!-- <link href="https://fonts.cdnfonts.com/css/walt-disneys-old-font" rel="stylesheet">
          font-family: "Walt Disneys Old Font", sans-serif; 
           font-family: "Frijole", sans-serif;-->
        <table>
            <caption>
                <small class="cal-nav">
                    <?php echo $this->navigation(); ?>
                </small>
            </caption>
            <tr>
                <?php
                $weekDays = ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'sa', 'Do'];
                foreach ($weekDays as $day) {
                    echo "<th><small>$day</small></th>";
                }
                ?>
            </tr>
            <?php
            $weekcount = 0;
            $nextMonthDay = 1;
            for ($beginWeekDay = 2 - $firstDay; $beginWeekDay <= ($dayOfMonth + 7) && $weekcount < 6; $beginWeekDay += 7) {
                $weekcount++;
                ?>
                <tr>
                    <?php $weekDay = 0; ?>
                    <?php for ($actualDay = $beginWeekDay; $actualDay <= $beginWeekDay + 6; $actualDay++) { ?>
                        <td style="<?php $forStyles = new CalendarStyles($weekDay, $isToday, $actualDay);
                        echo $forStyles->getStyles(); ?><?php if ($actualDay <= 0 || $actualDay > $dayOfMonth) {
                              echo 'background-color: transparent; color: aliceblue; border: none;';
                                echo 'text-shadow: 0.1vh 0.1vw 5px black;';
                          } ?>">
                            <?php




                            // Mostrar día correspondiente
                            if ($actualDay <= 0) {
                                // Día del mes anterior 
                                // echo $this->time->previousDays();
                                echo $actualDay + $dayOfMonth;


                            } elseif ($actualDay > $dayOfMonth) {
                                // Día del mes siguiente
                                // echo $this->time->nextDays();
                                // echo $actualDay - $dayOfMonth;
                                echo $nextMonthDay++;
            
                            } else {
                                // Día del mes actual
                                echo $actualDay;
                            }
                            ?>

                        </td>
                        <?php $weekDay++;
                    }

                    ?>

                </tr>
            <?php } ?>
        </table>

        <?php

    }
}
