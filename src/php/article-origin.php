<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$toDownload = [];
foreach( $arResult["PROPERTIES"]["src_document"]["VALUE"] as $fileID) {
    if ($arFile = CFile::GetByID($fileID)->Fetch()) {
        $toDownload[] = (int)$fileID;
    }
}
if (!empty($toDownload)) {
    $downloadLink = "/local/ajax/download.php?from=materials&";
    foreach($toDownload as $fileID) {
        $downloadLink .= '&files[]='.$fileID;
    }
}

?>
<main class="main">
    <div class="container container--large container--flex">
        <button class="button button--transparent menu-switcher">Меню</button>

        <?$APPLICATION->IncludeComponent("bitrix:menu", "vertical_multilevel1", Array(
	"ROOT_MENU_TYPE" => "category",	// Тип меню для первого уровня
		"MAX_LEVEL" => "1",	// Уровень вложенности меню
		"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
		"USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
		"MENU_CACHE_TYPE" => "A",	// Тип кеширования
		"MENU_CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
		"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
		"COMPONENT_TEMPLATE" => "vertical_multilevel",
		"DELAY" => "N",	// Откладывать выполнение шаблона меню
		"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
		"MENU_THEME" => "site"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "Y"
	)
);?>
        <div class="container container--middle">
            <article class="article-detail">
                <? $fileID = $arResult["PROPERTIES"]["src_document"]["VALUE"][0];
                    $pathFileID = CFile::GetPath($fileID);
                ?>
                <?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
                <header class="article-detail__header">
                    <h2 class="article-detail__title"><?=$arResult["NAME"]?></h2>
                </header>
                <div class="article-detail__content">
                <?endif;?>

            	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
                	<div class="article-detail__img-wrap">
                		<img
                			class="article-detail__img"
                			src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
                			alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
                			title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
                			/>
        			</div>
            	<?endif?>

            	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
            		<span class="news-date-time"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
            	<?endif;?>
                    <? if (!empty($arResult["FIELDS"]['PREVIEW_PICTURE'])) {
                        $pImg = $arResult["FIELDS"]['PREVIEW_PICTURE'];
                     ?>
                        <? if(!$arResult["DETAIL_PICTURE"]) {
                            echo '<div class="article-detail__image-container">
                                <img class="article-detail__img" src="' . $pImg["SRC"] . '">
                            </div>';
                        }?>

                    <? } ?>
                <div class="article-detail__info">
            	<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
            		<p class="article-detail__info-desc"><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
            	<?endif;?>
            	<?if($arResult["NAV_RESULT"]):?>
            		<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><?endif;?>
            		<?echo $arResult["NAV_TEXT"];?>
            		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
            	<?elseif($arResult["DETAIL_TEXT"] == ''):?>
        	            <p class="article-detail__info-desc"><?echo $arResult["PREVIEW_TEXT"];?></p>
                        <div class="article-detail__favorite">
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:asd.favorite.button",
                                "",
                                Array(
                                    "BUTTON_TYPE" => "fav",
                                    "ELEMENT_ID" => $arResult["ID"],
                                    "FAVED" => "",
                                    "FAV_TYPE" => "materials",
                                    "GET_COUNT_AFTER_LOAD" => "Y",
                                    "SET_COUNT" => ""
                                )
                            );?>
                        </div>
                        <?if ($downloadLink) {?>
                        <div class="download_archive">
                            <a target='blank' href="<?=$downloadLink?>">Скачать архив</a>
                        </div>
                        <? } ?>

            	</div>

            	</div>
                        <ul class="article__print">
    <?/*
                            <a href="<?=$pathFileID?>"><i class="fa fa-download"></i> Скачать</a></li>
    */?>
    <? foreach( $arResult["PROPERTIES"]["src_document"]["VALUE"] as $fileID) {?>
    <?                    $arFile = CFile::GetByID($fileID)->Fetch();                 ?>
                          <li class="article__doc" style='display:flex;'>
                            <span><?=htmlspecialcharsBx($arFile['ORIGINAL_NAME']);?></span>
                            <a target='blank' href="/local/tools/getfile.php?fid=<?=$fileID?>&id=<?=$arResult['ID']?>">Скачать</a></li>
    <? } ?>
                        </ul>

            		<p class="article-detail__content-info"><?echo $arResult["DETAIL_TEXT"];?></p>
            	<?else:?>
                	<div class="article__nav">
                            <div class="article-detail__favorite">
                                <?$APPLICATION->IncludeComponent(
                                    "defaultTemplate:asd.favorite.button",
                                    "",
                                    Array(
                                        "BUTTON_TYPE" => "fav",
                                        "ELEMENT_ID" => $arResult["ID"],
                                        "FAVED" => "",
                                        "FAV_TYPE" => "materials",
                                        "GET_COUNT_AFTER_LOAD" => "Y",
                                        "SET_COUNT" => ""
                                    )
                                );?>
                            </div>
                        <?if ($downloadLink) {?>
                        <div class="download_archive" style="margin:20px 0;">
                            <a target='blank' href="<?=$downloadLink?>" style='min-width:75px;'><i class="fa fa-download"></i> Скачать архив</a></li>
                        </div>
                        <? } ?>
                            <ul class="article-detail__print">
    <?/*
                            <a href="<?=$pathFileID?>"><i class="fa fa-download"></i> Скачать</a></li>
    */?>
    <? foreach( $arResult["PROPERTIES"]["src_document"]["VALUE"] as $fileID) {?>
    <?                    $arFile = CFile::GetByID($fileID)->Fetch();                 ?>
                          <li class="article__doc" style='display:flex;'>
                            <span style=" padding-right: 20px; line-height: 30px;"><?=htmlspecialcharsBx($arFile['ORIGINAL_NAME']);?></span>
                            <a class="article-preview__button article-preview__button--download" style=" min-width: 75px;" href="/local/tools/getfile.php?fid=<?=$fileID?>&id=<?=$arResult['ID']?>"><i class="fa fa-download"></i> Скачать</a></li>
    <? } ?>
    <?/* if (!empty($fileID)) {?>
                            <a class="article-preview__button article-preview__button--download" href="/local/tools/getfile.php?fid=<?=$fileID?>&id=<?=$arResult['ID']?>"><i class="fa fa-download"></i> Скачать</a></li>
    <? }*/ ?>
                            </ul>
                	    </div>
            	    <div class="article-detail__share">
            		    <p>Поделиться:</p>
                        <script src="https://yastatic.net/share2/share.js"></script>
                            <div class="ya-share2" data-curtain data-shape="normal" data-limit="3" data-title="Передать ссылку" data-more-button-type="short" data-services="vkontakte,facebook,whatsapp"></div>
            		</div>
            	    <p class="article-detail__content-info"><?echo $arResult["DETAIL_TEXT"];?></p>

            	<?endif?>
            	<?foreach($arResult["FIELDS"] as $code=>$value):
            		if ('PREVIEW_PICTURE' == $code || 'DETAIL_PICTURE' == $code)
            		{
            continue;
            			?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?
            			if (!empty($value) && is_array($value))
            			{
            				?><img border="0" src="<?=$value["SRC"]?>"><?
            			}
            		}
            		else
            		{
            			?><p class="article-detail__content-info"><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?></p><?
            		}
            		?><br />
            	<?endforeach;
            	if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
            	{
            		?>
            		<div class="news-detail-share">
            			<noindex>
            			<?
            			$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
            					"HANDLERS" => $arParams["SHARE_HANDLERS"],
            					"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
            					"PAGE_TITLE" => $arResult["~NAME"],
            					"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
            					"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
            					"HIDE" => $arParams["SHARE_HIDE"],
            				),
            				$component,
            				array("HIDE_ICONS" => "Y")
            			);
            			?>
            			</noindex>
            		</div>
            		<?
            	}
            	?>
            </article>
        </div>
    </div>
</main>
