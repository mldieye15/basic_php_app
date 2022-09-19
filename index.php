<?php

require_once('lib/functions.php');

$conn = connect();

public_header('Home');

require_once('site/accueil.php');

template_footer();