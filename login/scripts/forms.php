<?php

interface Forms
{
    public function form(): void;
}

class FormLogin implements Forms
{
    public function form(): void
    {
        require_once __DIR__ . '/partials/header.php';
        ?>
        <form action="iniciar_sesion.php" method="post" id="login" autocomplete="off">
            <h5>Inicio de sesion</h5>
            <fieldset class="campos">
                <label for="email"><i style="font-size:24px" class="fa">&#xf0e0;</i></label>
                <input type="text" name="email" id="email" placeholder="Usuario o e-Mail">
            </fieldset>
            <fieldset class="campos">
                <label for="password"><i style="font-size:24px" class="fa">&#xf084;</i></label>
                <input type="password" name="password" id="password" placeholder="introduzca su contraseña" required>
            </fieldset>
            <fieldset class="buttons">
                <button type="submit" class="btnsave">
                    Login <i style="font-size:14px" class="fa">&#xf1d9;</i>
                </button>
                <a href="viewRegisterForm.php">
                    Registro
                </a>
                <button type="submit" class="btnclean">
                    Borrar <i style="font-size:14px" class="fa">&#xf12d;</i>
                </button>
            </fieldset>
        </form>
        <?php
    }
}

class RegisterForm implements Forms
{
    public function form(): void
    {
        require_once __DIR__ . '/partials/header.php';
        ?>
        <form action="" method="post" id="register" autocomplete="off">
            <h5>Registro de usuarios</h5>
            <section>
            <div>
            <fieldset id="fullName" class="campos">
                <legend>Nombre Completo</legend>
                <label for="nombre"><i style="font-size:24px" class="fa">&#xf2bc;</i></label>
                <span class="fullName">
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre de pila">
                    <!-- <input type="text" name="apellido_uno" id="apellido_uno" placeholder="Primer apellido">
                    <input type="text" name="apellido_dos" id="apellido_dos" placeholder="Segundo apellido"> -->
                </span>
            </fieldset>
            
            <fieldset class="campos">
                <legend>Nombre de usuario</legend>
                <label for="nombre__usuario"><i style="font-size:24px" class="fa">&#xf2bd;</i></label>
                <input type="text" name="nombre__usuario" id="nombre__usuario" placeholder="Nombre de usuario">
            </fieldset>
            </div>
            <div class="caja__email_password">
            <fieldset class="campos">
                <legend>e-Mail y Contraseña</legend>
                <label for="email"><i style="font-size:24px" class="fa">&#xf0e0;</i></label>
                <input type="email" name="email" id="email" placeholder="introduzca su e-Mail" required>
            </fieldset>
            <fieldset class="campos" id="passwords">
                <label for="password"><i style="font-size:24px" class="fa">&#xf084;</i></label>
                <span class="passwords">
                <input type="password" name="password" id="password" placeholder="introduzca su contraseña" required>
                <input type="text" name="repite_password" id="repite_password" placeholder="Repita su contraseña">
                </span>
            </fieldset>
            </div>
            </section>           
            <fieldset class="buttons">
                <button type="submit" class="btnsave">
                    Registro <i style="font-size:14px" class="fa">&#xf1d9;</i>
                </button>
                <a href="viewLoginForm.php">
                    Login
                </a>
                <button type="submit" class="btnclean">
                    Borrar <i style="font-size:14px" class="fa">&#xf12d;</i>
                </button>
            </fieldset>
        </form>
        <?php
    }
}

class FactoryForms
{
    public static function render($type): Forms
    {
        return match ($type) {
            'login' => new FormLogin(),
            'register' => new RegisterForm(),
            default => throw new InvalidArgumentException("Problema con el formulario"),
        };
    }
}