<script src="<?php echo base_url();?>application/third_party/js/pathfinding-browser.min.js"></script>
<?php
//http://rpgworld.altervista.org/335/ (all but shaman)

//talent_id,tier,column,dependent_on

//different arrows:
//arrow_down_3,arrow_down_2,arrow_down_1,arrow_right_1_down_2,arrow_left_1_down_1,arrow_left_1_down_2,arrow_right_1_down_1,arrow_right_1,arrow_left_1,arrow_right_1_down_2,
//we either have to use this or write a pathfinding thing to draw to the dependent talent based on empty grid paths. https://github.com/qiao/PathFinding.js using best-first search is probably best for this, just add "grid-occupied" / "grid-unoccupied" class
//each grid point will have a class "grid_spec_x_tier_y_col_z"
?>
<div class="talent-layout row">
    <?php foreach($specs as $thisSpec) { ?>
    <div class="col-md-4">
        <?php $currentRow = 1;
        echo '<div class="row">';
        foreach($talents[$thisSpec->id] as $thisTalent) {
            if($thisTalent->tier > $currentRow) {
                echo '<div class="row">';
            }

            //create the grid cell + any previous empty cells

            if($thisTalent->tier > $currentRow) {
                echo '</div>';
                $currentRow = $thisTalent->tier;
            }
        } ?>
        <?php } ?>


        <script>
            <?php foreach($spec as $thisSpec) { ?>
            var finder = new PF.BestFirstFinder();
            var grid = new PF.Grid(11,4);
            <?php foreach($talents[$thisSpec->id] as $thisTalent) { ?>
            grid.setWalkableAt(<?php echo $thisTalent->tier; ?>,<?php echo $thisTalent->column; ?>,false); //js
            <?php } ?>

            var path = finder.findPath((x,y of $(#'$thisTalent->talent_id')), (x,y of $(#'$thisTalent->dependent_on')));

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