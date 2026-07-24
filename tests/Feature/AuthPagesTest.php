<?php

it('displays separate login and register pages', function () {
    $this->get('/login')->assertOk()->assertSee('Connexion');
    $this->get('/register')->assertOk()->assertSee('Créer un compte');
});
