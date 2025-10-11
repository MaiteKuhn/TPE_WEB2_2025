<?php
class VistaAuth {

    public function mostrarLogin($error, $user) {
        require_once './templates/form_login.phtml';
    }

    public function mostrarError($error, $user) {
        echo "<h1>$error</h1>";
    }
}