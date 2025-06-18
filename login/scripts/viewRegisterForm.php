<?php
require_once __DIR__ . '/forms.php';

?>
<link rel="stylesheet" href="css/registerForm.css"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  
<?php

$register = FactoryForms::render('register');
echo $register->form();