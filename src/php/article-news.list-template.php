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
?>
<div class="container container--middle container--list">
        <?if($arParams["DISPLAY_TOP_PAGER"]):?>
        	<?=$arResult["NAV_STRING"]?><br />
        <?endif;?>
        <?foreach($arResult["ITEMS"] as $arItem):?>
        	<?
        	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        	?>
        	<article class="article-preview" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        	    <header class="article-preview__header">
    			    <a class="forStorage" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
                			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                				    <img
                						class="article-preview__icon"
                						border="0"
                						src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                						width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
                						height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
                						alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                						title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
                						style="float:left"
                						/>
                			<?else:?>
                				<img
                					class="article-preview__icon"
                					border="0"
                					src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                					width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
                					height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
                					alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                					title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
                					style="float:left"
                					/>
                			<?endif;?>
                		<?endif?>
                		<div class="article-preview__info">
                		<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
                			<span class="news-date-time"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
                		<?endif?>
                		<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
                			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                				<h4 class="article-preview__title"><?echo $arItem["NAME"]?></h4>
                			<?else:?>
                				<h4 class="article-preview__title"><?echo $arItem["NAME"]?></h4><br />
                			<?endif;?>
                		<?endif;?>
                		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
                			<p class="article-preview__subtitle"><?echo $arItem["PREVIEW_TEXT"];?></p>
                		<?endif;?>
                		<?foreach($arItem["FIELDS"] as $code=>$value):?>
                			<small>
                			<?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
                			</small>
                		<?endforeach;?>
                		<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
                			<small>
                			    test
                			<?=$arProperty["NAME"]?>:&nbsp;
                			<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
                				<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
                			<?else:?>
                				<?=$arProperty["DISPLAY_VALUE"];?>
                			<?endif?>
                			</small>
                		<?endforeach;?>
                		</div>
        		    </a>
    		    </header>
    		    <div class="article-detail__favorite">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:asd.favorite.button",
                        "",
                        Array(
                            "BUTTON_TYPE" => "fav",
                            "ELEMENT_ID" => $arItem["ID"],
                            "FAVED" => "",
                            "FAV_TYPE" => "materials",
                            "GET_COUNT_AFTER_LOAD" => "Y",
                            "SET_COUNT" => ""
                        )
                    );?>
                </div>
        	</article>
        <?endforeach;?>
        <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
        	<?=$arResult["NAV_STRING"]?>
        <?endif;?>
        </div>
