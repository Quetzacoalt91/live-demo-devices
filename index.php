<?php
/*
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2014 PrestaShop SA
*  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

global $iso_lang, $translations;

$iso_lang = 'en';
if (!isset($_GET['iso_lang']))
{
	header('HTTP/1.1 301 Moved Permanently');
	header('Location: /en/');
	exit;
}
elseif (!in_array($_GET['iso_lang'], array('fr', 'en', 'es', 'it', 'de', 'nl', 'pl', 'ru', 'pt')))
{
	header('HTTP/1.1 404 Not Found');
	header('Status: 404 Not Found');
}
else
	$iso_lang = $_GET['iso_lang'];

$translations = array(
	'fr' => array(
		'PrestaShop Demo' => 'Demo PrestaShop',
		'Looking for a powerful shopping cart software? Try the PrestaShop Demo now and visualize it on mobile, tablet and desktop.' => 'Vous cherchez un logiciel e-commerce simple et puissant ? Essayez PrestaShop dès maintenant aux formats web, mobile et tablette.',
		'Desktop' => 'Web',
		'Tablet' => 'Tablette',
		'Smartphone' => 'Mobile',
		'Explore<br>Front Office' => 'Explorez<br>la boutique',
		'Explore<br>Back Office' => 'Explorez le<br>Panneau d\'administration',
		'Discover<br>PrestaShop' => 'Découvrez<br>PrestaShop',
		'' => '',
	),
);
function translate($s)
{
	global $iso_lang, $translations;
	if ($iso_lang == 'en' || !isset($translations[$iso_lang][$s]))
		echo $s;
	else
		echo $translations[$iso_lang][$s];
}

?><!DOCTYPE html>
<html lang="<?php echo $iso_lang ?>">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
		<title><?php translate('PrestaShop Demo') ?></title>
		<meta name="description" content="<?php translate('Looking for a powerful shopping cart software? Try the PrestaShop Demo now and visualize it on mobile, tablet and desktop.') ?>" />
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="/css/screen.css">
		<link rel="shortcut icon" href="/img/favicon.ico" type="image/vnd.microsoft.icon" />
	</head>
	<body>
		<div id="header">
			<div id="logo" class="block_header">
				<a href="http://demo.prestashop.com/"><img src="/img/logo_prestashop.png" /></a>
			</div>
			<ul id="devices">
				<li>
					<a href="javascript:void(0);" class='change-device active' data-target='desktop' >
						<i class="material-icons">&#xE30C;</i>
					</a>
				</li>
				<li>
					<a href="javascript:void(0);" class='change-device' data-target='tablet-h'>
						<i class="material-icons">&#xE32F;</i>
					</a>
				</li>
				<li>
					<a href="javascript:void(0);" class='change-device tablet-v' data-target='tablet-v'>
						<i class="material-icons">&#xE32F;</i>
					</a>
				</li>
				<li>
					<a href="javascript:void(0);" class='change-device' data-target='mobile'>
						<i class="material-icons">&#xE325;</i>
					</a>
				</li>
			</ul>
			<a class="btn btn-download" target="_blank" href="http://www.prestashop.com/"><?php translate('Start now') ?></a>
			<a class="btn btn-explore btn-explore-bo" data-view="back" href="http://bo.demo.prestashop.com/demo/index.php?controller=AdminLogin&email=demo<?php if ($iso_lang != 'en') echo $iso_lang; ?>@prestashop.com&password=prestashop_demo"><?php translate('Explore Back Office') ?></a>
			<a class="btn btn-explore btn-explore-front hide" data-view="front" href="http://fo.demo.prestashop.com/<?php echo $iso_lang ?>/"><?php translate('Explore Front Office') ?></a>
		</div>
		<a class="btn btn-collapse" href="javascript:void(0);"><span class="hide-header"><?php translate('Hide') ?></span><span class="show-header"><?php translate('Show') ?></span></a>
		<div id="iframe-container" class="desktop">
			<div id="iframe-wrapper">
				<div id="loadingMessage"><img src="/img/loading.gif" alt="loading"></div>
				<iframe id="framelive" name="framelive"></iframe>
			</div>
		</div>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="/js/socket.io.js"></script>
    
    <?php if (getenv('MS_DOMAIN') !== false) { ?>
    <script>var baseDomain = <?php echo json_encode(getenv('MS_DOMAIN')); ?>;</script>
    <?php } ?>

		<script src="/js/app.js"></script>
		<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-WHRX84"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-WHRX84');
		</script>
	</body>
</html>
