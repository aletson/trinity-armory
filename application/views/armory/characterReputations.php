<div class="pull-right">
    <h1><?php echo $characterDisplayData->characterName; ?></h1><br/>
    <h2><?php echo $characterDisplayData->level . ' ' . $characterDisplayData->raceName . ' ' . $characterDisplayData->className; //TODO add spec ?></h2><br/>
</div>
<br/>

<div class="row">
    <div class="col-md-3">
        <?php $this->load->view('armory/sidebar', $characterDisplayData); ?>
    </div>
    <div class="col-md-6">
        <?php
        foreach($reputations as $thisReputation) {
            echo '<div class="progress">';
            echo '<div class="progress-bar progress-bar-' . $thisReputation->barClass
                . '" role="progressbar" aria-valuenow="'
                . round($thisReputation->calcStanding / $thisReputation->maxStanding * 100)
                . '" aria-valuemin="0" aria-valuemax="100" style="width:'
                . round($thisReputation->calcStanding / $thisReputation->maxStanding * 100) . '%"><span>'
                . $thisReputation->name . ': ' . $thisReputation->standingName . ' (' . $thisReputation->calcStanding . '/'
                . $thisReputation->maxStanding . ')</span></div>';
            echo '</div>';
        }
        ?>
    </div>
    <div class="col-md-3">

    </div>
</div>