<?php

class CalendarStyles
{
    private int $indexWeekDay;
    private int $actualDay;
    private int $evaluatedDay;

    public function __construct($indexWeekDay, $actualDay, $evaluatedDay)
    {
        $this->indexWeekDay = $indexWeekDay;
        $this->actualDay = $actualDay;
        $this->evaluatedDay = $evaluatedDay;
        $this->daysStyle();
    }

    public function __get($name)
    {
        if ($name === 'indexWeekDay') {
            return $this->indexWeekDay;
        } elseif ($name === 'actualDay') {
            return $this->actualDay;
        } elseif ($name === 'evaluatedDay') {
            return $this->evaluatedDay;
        }
        // Opcional: lanzar error si no existe
        throw new Exception("Propiedad '$name' no definida");
    }

    public function __set($name, $value)
    {
        if ($name === 'indexWeekDay') {
            $this->indexWeekDay = $value;
        } elseif ($name === 'actualDay') {
            $this->actualDay = $value;
        } elseif ($name === 'evaluatedDay') {
            $this->evaluatedDay = $value;
        } else {
            throw new Exception("Propiedad '$name' no definida");
        }
    }

    private function daysStyle()
    {
        $style = '';

        if ($this->indexWeekDay <= 4) {
            $style .= 'color: black;';
        } elseif ($this->indexWeekDay == 5) {
            $style .= 'color: cornflowerblue;';
        } else {
            $style .= 'color: red; text-shadow: -.1vw -.1vw 1px gray, .1vw .1vw 1px gray;';
        }

        if ((int) $this->actualDay === (int) $this->evaluatedDay) {
            $style .= ' background-color: #8c8c8c; color: black; font-weight: bold; border-radius: 1.2vw;';
            $style .= ' font-size: 23pt; text-shadow: 0vh 0vw 15px aliceblue; opacity: 1;';
            $style .= ' transform: rotateY(-15deg) rotateX(-15deg);';
        } 

        if (((int) $this->indexWeekDay == 5) && (int) $this->actualDay === (int) $this->evaluatedDay) {
            $style .= 'color: dodgerblue; background-color: cornflowerblue; font-size: 23pt;';
        } elseif (((int) $this->indexWeekDay == 6) && (int) $this->actualDay === (int) $this->evaluatedDay) {
            $style .= 'color: hotpink; background-color: crimson; font-size: 23pt; text-shadow: 0vh 0vw 25px aliceblue;';
        }

        return $style;
    }

    public static function calendarStyle()
    {
        return <<<STYLE

        <style>
            @import url('https://fonts.cdnfonts.com/css/frijole');
            @import url('https://fonts.cdnfonts.com/css/walt-disneys-old-font');
            @import url('https://fonts.cdnfonts.com/css/all-disney');
            @import url('https://fonts.cdnfonts.com/css/casofa');

            table {
                transform: scale(0.6, 0.6);
                transform-origin: center center;
                width: 30vw;
                height: 50vh;
                padding-bottom: 0.5vw;
                margin: 3vh auto;
               /* background-color: goldenrod; */
                background-image: url(calendario/assets/imatges/fondogris.jpeg); 
                background-position: center center;
                background-repeat: no-repeat;
                background-size: cover;
               /* opacity: 0.7; */
                font-family: 'Frijole', sans-serif;
                empty-cells: hide;
                border-top: 0.2vw double dimgray;
                border-bottom: 0.2vw double dimgray;
                border-top-right-radius: 0.5vw;
                border-top-left-radius: 0.5vw;
                box-shadow: 0 0 12px black;
                
            }

            table th {
                border-bottom: 0.2vw double black;
                font-size: 19pt;
                font-family: 'Waltograph UI', sans-serif;
            }

            table td {
                border: .2vw double steelblue;
                border-collapse: separate;
                border-radius: 0.3vw;
                text-align: center;
                font-size: 19pt;
                text-shadow: -.1vw -.1vw 1px black, .1vw .1vw 1px black;
                opacity: 0.5; 
                mix-blend-mode: screen;
            }

            table th:nth-child(-n+5) {
                color: darkolivagreen;
                background-color: yellow;
                opacity: 0.7;
                text-shadow: -.1vw -.1vw 1px red, .1vw .1vw 1px red;
            }

            table th:nth-child(n+6) {
                color: dodgerblue;
                background-color: navy;
                font-family: 'Frijole', sans-serif;
                
            }

            table th:nth-child(n+7) {
                text-shadow: -.1vw -.1vw 1px yellow, .1vw .1vw 1px yellow;
                color: firebrick;
                background-color: crimson;
                font-family: 'Frijole', sans-serif;
            }

            table td:nth-child(-n+5) {
                background-color: azure;                
                text-shadow: 0.2vh 0.2vw 1px aliceblue; 
               /* font-family: 'Casofa', sans-serif; */
            }

            table td:nth-child(n+6) {
                
                background-color: cadetblue;
                opacity: 1 !important;
                mix-blend-mode: normal !important;
            }

            table td:nth-child(n+7) {
                background-color: lightpink;
                opacity: 1 !important;
                mix-blend-mode: normal !important;
            }

            caption {
                caption-side: bottom;
            }

            caption .cal-nav {
                width: 100%;
                display: flex;
                justify-content: space-between;
                align-items: center;
                text-align: center;
                font-size: 15pt;
                margin-bottom: 0.5em;
                background-color: goldenrod;
                color: darkslategray;
                padding: 0.3em 0;
            }

            caption .cal-nav a {
                margin: 0 1em;
                color: navy;
                text-decoration: none;
                font-weight: bold;
                font-size: 25pt;
                padding: 0.3vh 0.5vw;
                border: 0.3vw double transparent;
                border-radius: 50%;
                transition: all 1s ease;
            }

            caption .cal-nav a:hover {
                border-radius: 50%;
                border: 0.3vw double cornflowerblue;
                text-align: center;
                vertical-align: middle;
            }

            caption .cal-nav strong {
                flex-grow: 1;
                text-align: center;
                margin: 0 1em;
            }
        </style>
        STYLE;
    }

    public function getStyles(): string
    {
        return $this->daysStyle();
    }


}