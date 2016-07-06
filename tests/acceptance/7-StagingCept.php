<?php 
date_default_timezone_set('America/New_York');

//Live project
//https://www.transifex.com/test-organization-4/wordpress-test-project/wptransifexdevnet-1/
$I = new AcceptanceTester($scenario);
$I->assertTrue(true);
$I->amOnPage('/wp-login.php');
$I->fillField('Username', 'admin');
$I->fillField('Password','admin');
$I->click('Log In');

$I->see('Dashboard');
$I->amOnPage('/wp-admin/options-general.php?page=transifex-live-integration');
$I->see('Transifex Live Translation Plugin Settings','h2');
$I->assertTrue($I->executeJS('return (jQuery("#transifex_live_settings_api_key").val()=="2699bc66df6546008d0a14acf26732a1")?true:false;'));

$I->executeJS('jQuery("#transifex_live_settings_enable_staging").click();');
$I->executeJS('jQuery("#transifex_live_sync").click();');
$I->wait(3);
$I->executeJS('jQuery("#transifex_live_submit").click();');

$I->wait(3);

$I->amOnPage('/');
$I->seeInSource('src="//cdn.transifex.com/live.js"');
$I->seeInSource('window.liveSettings');
$I->seeInSource('"api_key":"2699bc66df6546008d0a14acf26732a1"');
$I->seeInSource('hreflang="en"');
$I->seeInSource('hreflang="zh-cn"');
$I->seeInSource('hreflang="fr"');
$I->seeInSource('hreflang="de"');
$I->seeInSource('hreflang="de-de"');