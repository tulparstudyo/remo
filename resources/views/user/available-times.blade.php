<?php

?>
<style>
    #docs-time-container{
        display: flex;

    }
    table.available-times{
        font-size: 10px;
        width: 100%;
    }
    table.available-times tr{

    }
    table.available-times tr td:nth-child(1) {
        width: 1px;
    }
    table.available-times tr td {
        padding: 3px 1px;
    }
    table.available-times tr:hover td{
        color: #1a202c;
        background-color: #d2d2d2;
    }
</style>
<table class="available-times">
    <?php foreach($hours as $hour=>$detail){ ?>
    <tr data-hour="<?=$hour?>">
        <td><?=$hour?></td><td><?=$detail?></td>
    </tr>
    <?php } ?>
</table>
