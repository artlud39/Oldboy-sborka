<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Конструкторы");
$APPLICATION->AddHeadScript(DEFAULT_TEMPLATE_PATH . "/main.js");
?>

<main class="main">
    <div class="container container--large container--flex">
        <button class="button button--transparent menu-switcher">Меню</button>
          <?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"vertical_multilevel1",
	array(
		"ROOT_MENU_TYPE" => "category",
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "Y",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "36000000",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"COMPONENT_TEMPLATE" => "vertical_multilevel1",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"MENU_THEME" => "site"
	),
	false,
	array(
		"ACTIVE_COMPONENT" => "Y"
	)
);?>

        <div class="container container--middle">
                <div class="sections">
                    <h1>Конструкторы</h1>
                    <ul>
                        <li><a href="https://oldboy.wiki/constructor-vk">ВКОНТАКТЕ</a></li>
                        <li><a href="https://oldboy.wiki/constructor-instagram">ИНСТАГРАМ</a></li>
                    </ul>
                </div>
            </div>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
