<?php
use \Tsugi\Core\LTIX;

if ( ! defined('COOKIE_SESSION') ) define('COOKIE_SESSION', true);

require_once "tsugi/config.php";

// Do this early to allow sanity-db.php to check in more detail after
// Headers has been sent
$PDOX = false;
try {
    define('PDO_WILL_CATCH', true);
    $PDOX = LTIX::getConnection();
    $LAUNCH = LTIX::session_start();
} catch(PDOException $ex){
    $PDOX = false;  // sanity-db-will re-check this below
}

if ( $PDOX !== false ) LTIX::loginSecureCookie();

$R = $CFG->apphome . '/';
$T = $CFG->wwwroot . '/';
$set = new \Tsugi\UI\MenuSet();
$set->setHome($CFG->servicename, $CFG->apphome);
if ( isset($CFG->lessons) ) {
        $set->addLeft('Lessons', $R.'lessons');
}
$OUTPUT->topNavSession($set);

$OUTPUT->header();
?>
<style>
a[target="_blank"]:after {
    font-family: "FontAwesome";
    content: " \f08e";
}
.goog-te-banner-frame.skiptranslate {
    display: none !important;
    } 
body {
    top: 0px !important; 
    }
</style>
