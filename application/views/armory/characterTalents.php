<script src="<?php echo base_url();?>application/third_party/js/pathfinding-browser.min.js"></script>
<style>
    .spec-tree {
        margin-top:10px;
        border: #cdcdcd medium solid;
        border-radius: 10px;
        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
    }
</style>
<?php
//http://rpgworld.altervista.org/335/ (all but shaman)

//talent_id,tier,column,requires

//different arrows:
//arrow_down_3,arrow_down_2,arrow_down_1,arrow_right_1_down_2,arrow_left_1_down_1,arrow_left_1_down_2,arrow_right_1_down_1,arrow_right_1,arrow_left_1,arrow_right_1_down_2,
//we either have to use this or write a pathfinding thing to draw to the dependent talent based on empty grid paths. https://github.com/qiao/PathFinding.js using best-first search is probably best for this, just add "grid-occupied" / "grid-unoccupied" class
//each grid point will have a class "grid_spec_x_tier_y_col_z"
?>
<div class="talent-layout row">
    <?php foreach($specs as $thisSpec) { ?>
    <div class="col-md-4" style="text-align: center">
        <div class="spec-tree">
        <?php $currentRow = 0;
        $currentCol = 0; ?>
        <div class="row"><div class="col-md-12"><img src="<?php echo base_url(); ?>images/spells_abilities/<?php echo $thisSpec->icon;?>.png" /></div></div><div class="row">
            <?php foreach($talents[$thisSpec->id] as $thisTalent) {
                if($thisTalent->Row > $currentRow) {
                    echo '</div><div class="row">';
                    $currentRow = $thisTalent->Row;
                } ?>
                <?php if ($thisTalent->Col <= $currentCol) {
                    $currentCol = $thisTalent->Col;
                } else {
                    for($i = 1; $i == ($thisTalent->Col - $currentCol); $i++) {
                        echo '<div class="col-md-3">&nbsp;</div>';
                    }
                }
                echo '<div class="col-md-3">' . (isset($thisTalent->Icon) ? '<img src="' . base_url() . 'images/spells_abilities/' . $thisTalent->Icon . '.png" />' : $thisTalent->TalentID) . '</div>';
            } ?>
            </div>
            </div>
        </div>
        <?php } ?>

</div>


<!-- The xml files have "requires" - we can import that data into armory_talents and be able to draw arrows.
        <script>
            <?php foreach($specs as $thisSpec) { ?>
            var finder = new PF.BestFirstFinder();
            var grid = new PF.Grid(11,4);
            <?php foreach($talents[$thisSpec->id] as $thisTalent) { ?>
            grid.setWalkableAt(<?php echo $thisTalent->Row; ?>,<?php echo $thisTalent->Col; ?>,false); //js
            <?php } ?>

            var path = finder.findPath((x,y of $(#'<?php echo $thisTalent->TalentID; ?>')), (x,y of $(#'<?php echo $thisTalent->requires; ?>')));

            if(!path.length) {
                console.log('Path could not be found for $thisTalent->talent_id);
            } else {
                while(path.length) {
                    var current = path.shift();
                    var point = document.querySelector('.grid_spec_x_tier_' + current[0] + '_col_' + current[1]');
                    point.classList.add('grid-path-found');
                }
            }
            <?php } ?>
        </script>
        -->