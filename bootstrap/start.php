$env = $app->detectEnvironment(array(
    'production' => array('prestodc7'),
    'local' => array('homestead', '.local')
));