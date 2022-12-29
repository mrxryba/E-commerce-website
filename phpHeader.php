<?php
$session = new Session();
$session->setSessionID();
$session->checkSessionID();
$currentUser = new CurrentUser();
$isLogged = $currentUser->isAuthenticated();
$isAdmin = $currentUser->isAdmin();
if ($isLogged) {
    $user = $currentUser->getUser();
} else {
    $unloggedUser = new UnloggedUser($session->getSessionID());
}
if ($isLogged) {
    $cart = new Cart($user->getSavedCartID());
} else {
    $cart = new Cart($unloggedUser->getSavedCartID());
}

