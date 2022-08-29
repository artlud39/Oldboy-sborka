<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
define("SITE_SERVER_PROTOCOL", (CMain::IsHTTPS()) ? "https://" : "http://"); // Переменная определяет протокол, по которому работает ваш сайт
$curPage = $APPLICATION->GetCurPage(false); // Получаем текущий адрес страницы ?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <?php
        use Bitrix\Main\Page\Asset;
        $APPLICATION->ShowHead();

    ?>
  <meta charset="UTF-8" />

  <title><?php $APPLICATION->ShowTitle()?></title>
  <?php
        $APPLICATION->ShowCSS();
        $APPLICATION->SetAdditionalCSS("/bitrix/css/main/font-awesome.css");
        Asset::getInstance()->addString('<meta name="viewport" content="width=device-width, initial-scale=1.0" />');
        Asset::getInstance()->addString('<meta http-equiv="X-UA-Compatible" content="ie=edge" />');
    ?>
  <link rel="icon" type="image/png" href="/favicon.ico" />
  <link rel="icon" href="/favicon/favicon.png" type="image/png">
  <link rel="shortcut icon" href="/favicon/favicon.png" type="image/png">
</head>

<body>
  <div id="panel"><?php $APPLICATION->ShowPanel(); ?></div>

  <header class="header-search">
    <div class="header-search__wrapper">
      <div class="header-search__logo header-search__logo--adaptive">
        <?php
          $curPage = $APPLICATION->GetCurPage(true);
          if ($curPage == SITE_DIR."index.php"){?>

        <a href="<?=SITE_DIR?>"><img class="header-search__img" src="<?=DEFAULT_TEMPLATE_PATH;?>/img/logo-with-text.svg"
            alt="Oldboy Barbershop vector logo" title="Oldboy Barbershop Главная"></a>

        <?}else{?>
        <a href="<?=SITE_DIR?>"><img class="header-search__img" src="<?=DEFAULT_TEMPLATE_PATH;?>/img/logo-with-text.svg"
            alt="Oldboy Barbershop vector logo" title="Oldboy Barbershop Главная"></a>

        <?}?>
      </div>
      <?if ($USER->IsAuthorized()) {?>
      <div class="header-search__search">
        <?$APPLICATION->IncludeComponent("bitrix:search.title", "search-title", Array(
          "NUM_CATEGORIES" => "1",	// Количество категорий поиска
            "TOP_COUNT" => "10",	// Количество результатов в каждой категории
            "ORDER" => "date",	// Сортировка результатов
            "USE_LANGUAGE_GUESS" => "Y",	// Включить автоопределение раскладки клавиатуры
            "CHECK_DATES" => "Y",	// Искать только в активных по дате документах
            "SHOW_OTHERS" => "N",	// Показывать категорию "прочее"
            "PAGE" => "/search/",	// Страница выдачи результатов поиска (доступен макрос #SITE_DIR#)
            "CATEGORY_0_TITLE" => "Wiki франчайзи",	// Название категории
            "CATEGORY_OTHERS_TITLE" => "OTHER",
            "CATEGORY_0_iblock_franchise" => array(
              0 => "all",
            ),
            "SHOW_INPUT" => "Y",	// Показывать форму ввода поискового запроса
            "INPUT_ID" => "title-search-input",	// ID строки ввода поискового запроса
            "CONTAINER_ID" => "search",	// ID контейнера, по ширине которого будут выводиться результаты
            "PRICE_CODE" => array(
              0 => "BASE",
            ),
            "PRICE_VAT_INCLUDE" => "Y",
            "SHOW_ANOUNCE" => "N",
            "PREVIEW_TRUNCATE_LEN" => "50",
            "SHOW_PREVIEW" => "Y",
            "PREVIEW_WIDTH" => "38",
            "PREVIEW_HEIGHT" => "38",
            "CONVERT_CURRENCY" => "N",
            "SHOW_INPUT_FIXED" => "Y"
          ),
          false,
          array(
          "ACTIVE_COMPONENT" => "Y"
          )
        );?>
      </div>
      <? } ?>
      <nav class="header-search__menu">
        <a class="header-search__button button" href="<?=SITE_DIR."personal/"?>">Личный кабинет</a>
        <?if ($USER->IsAuthorized()) {?>
        <a class="header-search__button button header-search__button--exit" href="<?echo $APPLICATION->GetCurPageParam("
          logout=yes", array( "login" , "logout" , "register" , "forgot_password" , "change_password" ));?>">Выйти</a>

        <? } ?>
      </nav>

    </div>
  </header>