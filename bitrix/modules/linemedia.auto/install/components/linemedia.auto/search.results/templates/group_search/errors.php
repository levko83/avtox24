<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<div class="lm-auto-search-parts-place">

<h2><?=GetMessage('LM_AUTO_SEARCH_ERRORS')?></h2>

<div class="lm-auto-errors">
<?foreach($arResult['ERRORS'] AS $error) {?>
    <div><?=$error?></div>
<?}?>
</div>

</div>