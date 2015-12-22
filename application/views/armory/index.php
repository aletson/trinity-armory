<div class="row">
    <div class="col-md-3 col-md-offset-1">
        <h1>Armory</h1>
    </div>
    <div class="col-md-8">
        <div class="pull-right">
            <input type="text" class="form-control" id="character-search" placeholder="Filter characters..."/>
        </div>
    </div>
</div>


<?php
$characterCount = 0;
foreach($characters as $thisCharacter) {
   /* if ($characterCount % 3 == 0) {
        echo '<div class="row">';
    }*/
    echo '<div class="col-md-3 character-container" style="text-align:right;">';
    echo '<a href="' . site_url() . '/armory/characterOverview/' . $thisCharacter->name . '">';
    echo '<h4><span class="character-name">' . $thisCharacter->name . '</span> ';
    echo '<small>' . $thisCharacter->level . '</small> ';
    echo '<img src="' . base_url() . $thisCharacter->characterIcon . '" title="' . $thisCharacter->raceName . ' ' . $thisCharacter->className . '"/></h4>';
    echo "</a>";
    echo "</div>";
    $characterCount++;
    /*if($characterCount % 3 == 0) {
        echo '</div>';
    }*/
}

?>
<script>
    $('#character-search').keyup(function() {
        $('.character-container').each(function(i) {
            var characterName = $(this).find('.character-name').text();
            console.log($('#character-search').val().toLowerCase());
            if(characterName.toLowerCase().indexOf($('#character-search').val().toLowerCase()) == -1 ) {
                $(this).hide();
            } else {
                $(this).show();
            }
        })
    })
</script>
