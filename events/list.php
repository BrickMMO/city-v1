<?php

define('APP_NAME', 'QR Codes');
define('PAGE_TITLE', 'Dashboard');
define('PAGE_SELECTED_SECTION', '');
define('PAGE_SELECTED_SUB_PAGE', '');

include('../templates/html_header.php');
include('../templates/nav_header.php');
include('../templates/nav_slideout.php');
include('../templates/nav_sidebar.php');
include('../templates/main_header.php');

include('../templates/message.php');

?>

<div class="w3-center">

    <input class="w3-input w3-border w3-margin" type="text" placeholder="Seach using RGB or colour name" style="max-width: 400px; display: inline-block;" id="search">

</div>

<hr>

<div class="w3-flex" style="flex-wrap: wrap; gap: 16px; align-items: stretch;" id="colour-list"></div>

<script>

let typingTimer;
const search = document.getElementById('search');

search.addEventListener('input', () => {
  clearTimeout(typingTimer);
  typingTimer = setTimeout(() => {
    getColours(search.value);
  }, 1000);
});

function getColours(q)
{

    let colourList = document.getElementById("colour-list");
    colourList.innerHTML = '';

    fetch("/api/search/" + q)
        .then((response)=>response.json())
        .then((responseJson)=>{

            console.log(responseJson.colours.length);

            for (let i = 0; i < responseJson.colours.length; i++) 
            {

                const colour = responseJson.colours[i];

                colourList.innerHTML += `
                    <div style="width: calc(33.3% - 16px); box-sizing: border-box; display: flex; flex-direction: column;">
                        <div class="w3-card-4 w3-margin-top" style="max-width:100%; height: 100%; display: flex; flex-direction: column;">
                            <header class="w3-container w3-green">
                                <h4 style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    <i class="fa-${colour.is_trans == 'yes' ? 'regular' : 'solid'} fa-square"></i>
                                    ${colour.name}
                                </h4>
                            </header>
                            <div class="w3-margin" style="background-color: #${colour.rgb}; height: 100px;"></div>
                            <div class="w3-container w3-center">
                                <span style="display: inline-block; white-space: nowrap; max-width: 100%; overflow: hidden; text-overflow: ellipsis;">
                                    <a href="#" onclick="return copy('#${colour.rgb}');"><i class="fa-solid fa-copy"></i></a>
                                    RGB: #${colour.rgb}
                                </span>
                            </div>
                        </div>
                    </div>
                    `;   


            }

        });
}

getColours('');

</script>

<?php

include('../templates/main_footer.php');
include('../templates/debug.php');
include('../templates/html_footer.php');