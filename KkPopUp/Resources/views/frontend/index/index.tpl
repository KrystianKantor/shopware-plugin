{extends file='parent:frontend/index/index.tpl'}

{block name="frontend_index_header_css_plugins" append}
    stylesheet" href='/custom/plugins/KkPopUp/Resources/views/frontend/css/popup.css
       {$smarty.block.parent}
{/block}


{block name='frontend_index_content' prepend}   
    <div class="pop-up" id="pop-up">
      <div class="pop-up__overlay" id="pop-up__overlay"></div>
      <div class="pop-up__slogan-wrapp">
        <div class="pop-up__close-button" id="pop-up__close-button">
          &#10005;
        </div>
        <span class="pop-up__slogan">{$KkPopUpSlogan}</span>
      </div>
    </div>


    {literal}
    <script>
    (function hanldePopUp() {
        const button = document.getElementById("pop-up__close-button");
        const overlay = document.getElementById("pop-up__overlay");

        const removePopup = (popup = document.getElementById("pop-up") )=>{
           popup ? popup.remove() : null;
        }

        button?.addEventListener("click", () => {
           removePopup();
        });

        overlay?.addEventListener("click", () => {
            removePopup();
        });
        })();
    {/literal}
    </script>
    {$smarty.block.parent}
{/block}