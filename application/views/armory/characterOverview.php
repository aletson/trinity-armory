<div class="pull-right">
    <h1><?php echo $characterDisplayData->characterName; ?></h1><br/>
    <h2><?php echo $characterDisplayData->level . ' ' . $characterDisplayData->raceName . ' ' . $characterDisplayData->className; //TODO add spec ?></h2><br/>
    <h3>Average Item Level: <?php echo round($sumItemLevel / $itemCount); ?></h3></div>
<br/>
<?php foreach($gear as $key => $thisGear) {
    $indexed_values[$thisGear->displayOrder] = $key;
} ?>

<div class="row">
    <div class="col-md-3"><?php $this->load->view('armory/sidebar', $characterDisplayData); ?></div>
    <div class="col-md-1">
        <?php
        for($displaySlot = 1; $displaySlot <= 8; $displaySlot++) {
            echo '<div class="gear-slot" id="gear-slot-' . $displaySlot . '" style="text-align:right;">';
            if (isset($indexed_values[$displaySlot])) {
                $thisGear = $gear[$indexed_values[$displaySlot]];
                echo '<a href="http://wotlk.openwow.com/item=' . $thisGear->itemEntry . '"><img src="' . base_url() . 'images/items/' . $thisGear->icon . '.png" height="47" width="47"/></a>';
            } else {
                echo '<img src="' . base_url() . 'images/items/item-empty-slot-' . $displaySlot . '.png" />';
            }
            echo '</div>';
        }
        ?>
    </div>
    <div class="col-md-4" style="text-align:center;"><img src="http://placekitten.com/404/404"  style="margin: auto;"/></div>
    <div class="col-md-1">
        <?php
        for($displaySlot = 9; $displaySlot <= 16; $displaySlot++) {
            echo '<div class="gear-slot" id="gear-slot-' . $displaySlot . '">';
            if (isset($indexed_values[$displaySlot])) {
                $thisGear = $gear[$indexed_values[$displaySlot]];
                echo '<a href="http://wotlk.openwow.com/item=' . $thisGear->itemEntry . '"><img src="' . base_url() . 'images/items/' . $thisGear->icon . '.png" height="47" width="47" /></a>';

            } else {
                echo '<img src="' . base_url() . 'images/items/item-empty-slot-' . $displaySlot . '.png" />';
            }
            echo '</div>';
        }
        ?>
    </div>
    <div class="col-md-3"><!-- wasted space --></div>
</div>
<div class="row">
    <div class="col-md-2 col-md-offset-5">
        <div class="row">

            <?php
            for($displaySlot = 17; $displaySlot <= 19; $displaySlot++) {
                echo '<div class="col-md-4" style="text-align:center;">';
                echo '<div class="gear-slot" id="gear-slot-' . $displaySlot . '">';
                if (isset($indexed_values[$displaySlot])) {
                    $thisGear = $gear[$indexed_values[$displaySlot]];
                    echo '<a href="http://wotlk.openwow.com/item=' . $thisGear->itemEntry . '"><img src="' . base_url() . 'images/items/' . $thisGear->icon . '.png" height="47" width="47" /></a>';
                } else {
                    echo '<img src="' . base_url() . 'images/items/item-empty-slot-' . $displaySlot . '.png" />';
                }
                echo '</div>';
                echo '</div>';
            }

            ?>
        </div>
    </div>
</div>