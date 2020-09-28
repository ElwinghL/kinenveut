<?php

$ma_variable = ""; ?>
<div id="content"></div>
<button onclick="displayJSONFromPHP()">Load JSON</button>
<script>
    function displayJSONFromPHP() {
        const variablePHP = <?php json_encode($ma_variable); ?>;
        document.getElementById("content").innerText = JSON.stringify(variablePHP, null, 1);
    }
</script>

