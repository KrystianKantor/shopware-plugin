{extends file="parent:frontend/index/index.tpl"}

{block name='frontend_index_content_wrapper' append}   
    <div class="pop-up" id="pop-up">
      <div class="pop-up__overlay" id="pop-up__overlay"></div>
      <div class="pop-up__slogan-wrapp">
        <div class="pop-up__close-button" id="pop-up__close-button">
          &#10005;
        </div>
        <span class="pop-up__slogan">{$KkPopUpSlogan}</span>
      </div>
    </div>
    {$smarty.block.parent}
{/block}
