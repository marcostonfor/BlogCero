<?php

class HeaderStyles
{

    public function __construct()
    {
    }

    public static function styles(): string
    {
        $stylesHeader = <<<HTML
<style>
@import url('https://fonts.cdnfonts.com/css/e-ecano');
@import url('https://fonts.cdnfonts.com/css/kun');
@import url('https://fonts.cdnfonts.com/css/bloody-office');
@import url('https://fonts.cdnfonts.com/css/frijole');


@keyframes colorsrotate {
    0% {
        color: hsl(34, 78%, 91%);
        transition: 2s !important;
        box-shadow: inset #696969 10vh 30vw 12px, #e6e6e6 0 0 12px;
    }

    25% {
        color: hsl(145, 78%, 91%);
        transition: 2s !important;
        box-shadow: inset #808080 10vh 30vw 12px, #cccccc 0 0 12px;
    }

    50% {
        color: hsl(225, 78%, 80%);
        transition: 2s !important;
        box-shadow: inset #1e8fffc5 10vh 30vw 12px, #1e8fffc5 0 0 12px;
    }

    75% {
        color: hsl(0, 0, 70%);
        transition: 2s !important;
        box-shadow: inset #cccccc 10vh 30vw 12px, #808080 0 0 12px;
    }

    100% {
        color: hsl(0, 0%, 41%);
        transition: 2s !important;
        box-shadow: inset #e6e6e6 10vh 30vw 12px, #696969 0 0 12px;
    }
}
@keyframes letrasTitulweb {
    from {
        transform: rotate3d(0, 0, 0, 0deg) translateY(5%);
    }

    to {
        transform: rotate3d(1, 2, 3, 360deg) translateY(-10%);
    }
}

@keyframes letrasTitulweb_bis {
    from {
        transform: rotate3d(0, 0, 0, 0deg) translateY(5%);
    }

    to {
        transform: rotate3d(1, 2, 3, -360deg) translateY(-10%);
    }
}

@keyframes shadowsTitulweb {
    from {
        box-shadow: 100px 100px 2px 20px rgba(105, 105, 105, 0.5) inset, -120px -120px 1px 20px rgba(244, 165, 96, 0.5) inset;
        filter: hue-rotate(150deg);
    }

    to {
        box-shadow: 0 0 0 transparent inset;
    }
}

.letra-titulweb {
    display: inline-block;
    margin: 2vw 0.3vw;
    animation: letrasTitulweb 3s infinite;
    border-radius: 100vw;
    filter: hue-rotate(135deg);
    transition: filter 3s;
    background-image: linear-gradient(0deg, orange, burlywood, teal, burlywood, orange);
    background-repeat: no-repeat;
    background-size: cover;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    -webkit-background-clip: text;

}

.l {
    animation-delay: 0s;
}

.e {
    animation-delay: 0.6s !important;
}

.n {
    animation: letrasTitulweb_bis 3s infinite;
    animation-delay: 1.2s;
}

.g {
    animation-delay: 1.8s;
}

.u {
    animation-delay: 2.4s;
}

.a {
    animation-delay: 3s;
}

.j {
    animation: letrasTitulweb_bis 3s infinite;
    animation-delay: 3.6s;
}

.e {
    animation-delay: 4.2s !important;
}

.s {
    animation-delay: 4.8s;
}
    header {
    width: 98%;
    margin: auto auto;
    padding: 2vh 0vw;
    background-image: url('../components/images/fondoHeader.png');
    background-repeat: repeat;
    background-size: 25%;
    background-position: center center;
    box-shadow: inset 20vh 30vw 12px 100px hsla(0, 0.00%, 50.20%, 0.30), inset 20vh 300vw 12px 100px hsla(0, 0.00%, 50.20%, 0.30);
    border-top-right-radius: 1vw;
    border-bottom-right-radius: 3vw;
    border-top-left-radius: 1vw;
    border-bottom-left-radius: 3vw;
    border-top: 0.05rem double black;
    overflow: hidden;
}

h1#titulweb {
    text-align: center;
    font-family: 'e Ecano', sans-serif;
    font-style: oblique;
    font-size: 470%;
    width: fit-content;
    margin: auto auto;
    padding: 1vw;
    border-radius: 2vw;
    background-image: radial-gradient(circle, rgba(255, 68, 0, 0.74), rgba(189, 183, 107, 0.5), rgba(255, 68, 0, 0.74));
    animation: shadowsTitulweb 4s infinite;
    transition: all 2s;
}
#sub-titulweb {
    text-align: center;
    color: hsl(0, 0.00%, 0.00%);
    background-color: hsla(240, 100%, 99%, 0.8); 
    font-family: 'Kun', sans-serif;
    font-size: 310%;
    border-radius: 0.6vw;
   /* mix-blend-mode: screen; */
   /* animation: colorsrotate 7s infinite; */
}
.dividerY {
    width: 01%;
    height: 2vw;
    border-bottom-right-radius: 30%;
    border-bottom-left-radius: 30%;
    border-top-right-radius: 75%;
    border-top-left-radius: 75%;
    background-color: darksalmon;
    outline: 0.2vw double crimson;
}
.dividerX {
    width: 10%;
    height: 2.8vh;
   /* border-left: none;
    border-right: none; */
    border-radius: 250%;
    background-color: darksalmon;
    outline: 0.7vw double crimson;
    transform: rotateX(-250deg);
}
.image-container {  
  position: relative; /* Needed to position the cutout text in the middle of the image */
  height: 100px; /* Some height */
  border: 0.2vw solid black;
  background-image: url('../components/images/fondoh2.jpeg');
  background-repeat: repeat;
  background-size: 25%;
  background-position: center center;
  overflow: hidden;
}
.text {
  font-weight: bold;
  margin: 0 auto; /* Center the text container */
/*  padding: 10px; */
  width: 75%;
  text-align: center; /* Center text */
  position: absolute; /* Position text */
  top: 50%; /* Position text in the middle */
  left: 50%; /* Position text in the middle */
  transform: translate(-50%, -50%); /* Position text in the middle */
  mix-blend-mode: screen; /* This makes the cutout text possible */
}
</style>        
HTML;
        return $stylesHeader;
    }
}
