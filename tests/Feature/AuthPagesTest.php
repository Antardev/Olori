<?php

it('displays separate login and register pages', function () {
    $this->get('/login')->assertOk()->assertSee('Connexion');
    $this->get('/register')->assertOk()->assertSee('Créer un compte');
});

it('has the public pages used by the storefront navigation', function () {
    $this->get('/a-propos')->assertOk();
    $this->get('/contact')->assertOk();
    $this->get('/vue-360')->assertOk();
});
