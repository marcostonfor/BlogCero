<?php

class MakeTime
{
    private string $defaultZone;
    private int $month;
    private int $year;
    private int $monthDays;
    private int $firstDayMonth;
    private int $today;
    private int $daysInPreviousMonth;
    private int $daysInNextMonth;

    public function __construct()
    {
        $this->defaultZone = 'Europe/Madrid'; // o la zona horaria que te corresponda.
        // Con GET se recoge el mes y el año o si no se usa los actuales.
        $this->month = isset($_GET['month']) ? (int) $_GET['month'] : date('n');
        $this->year = isset($_GET['year']) ? (int) $_GET['year'] : date('Y');
        // Calendario.
        // Días del mes del calendario solicitado.
        $this->monthDays = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);
        // Día de la semana del primer día del mes solicitado (1=Lunes, ..., 7=Domingo)
        $this->firstDayMonth = date('N', mktime(0, 0, 0, $this->month, 1, $this->year));
        $this->today = date('j'); // Usa date('j') en lugar de date('d') para evitar comparaciones con cadenas tipo '09' vs 9.

    }
/*     public function nextDays()
    {
        $daysInMonth = date('t', mktime(0, 0, 0, $this->month, 1, $this->year));
        $lastWeekday = date('w', mktime(0, 0, 0, $this->month, $daysInMonth, $this->year));

        // Ajustar para semana que termina en domingo
        $this->daysInNextMonth = (7 - (($lastWeekday + 6) % 7) - 1 + 7) % 7;
        echo $this->daysInNextMonth;
    }


    public function previousDays()
    {
        $daysInMonth = date('t', mktime(0, 0, 0, $this->month, 1, $this->year));
        // Día de la semana del primer día del mes actual (0 = domingo, ..., 6 = sábado)
        $firstWeekday = date('w', mktime(0, 0, 0, $this->month, $daysInMonth, $this->year));

        // Ajustar para semana que empieza en lunes:
        // Si el primer día es domingo (0), queremos que sean 6 días de relleno.
        // Si es lunes (1), 0 días de relleno.
        // Si es martes (2), 1 día de relleno, etc.
        $this->daysInPreviousMonth = ($firstWeekday == 0) ? 6 : $firstWeekday - 1;
        echo $this->daysInPreviousMonth;
    }

 */


    public function __get($name)
    {
        if ($name === 'defaultZone') {
            return $this->defaultZone;
        } elseif ($name === 'month') {
            return $this->month;
        } elseif ($name === 'year') {
            return $this->year;
        } elseif ($name === 'monthDays') {
            return $this->monthDays;
        } elseif ($name === 'firstDayMonth') {
            return $this->firstDayMonth;
        } elseif ($name === 'today') {
            return $this->today;
        }

        // Opcional: lanzar error si no existe
        throw new Exception("Propiedad '$name' no definida");
    }

    public function __set($name, $value)
    {
        if ($name === 'defaultZone') {
            $this->defaultZone = $value;
        } elseif ($name === 'month') {
            $this->month = (int) $value;
        } elseif ($name === 'year') {
            $this->year = (int) $value;
        } elseif ($name === 'monthDays') {
            $this->monthDays = (int) $value;
        } elseif ($name === 'firstDayMonth') {
            $this->firstDayMonth = (int) $value;
        } elseif ($name === 'today') {
            $this->today = (int) $value;
        } else {
            throw new Exception("Propiedad '$name' no definida");
        }
    }
}


