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
        <?php foreach($reputations as $thisReputation) { ?>
            <div class="row">
                <div class="col-md-6" style="text-align:center;"><?php echo $thisReputation->name; ?></div>
                <div class="col-md-2" style="text-align:center;"><?php echo $thisReputation->standingName; ?></div>
                <div class="col-md-4">
                    <div class="progress">
                        <div class="progress-bar progress-bar-<?php echo $thisReputation->barClass; ?>" role="progressbar" aria-valuenow="<?php echo round($thisReputation->calcStanding / $thisReputation->maxStanding * 100); ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round($thisReputation->calcStanding / $thisReputation->maxStanding * 100);?>%">
                <span>
                    <?php echo $thisReputation->calcStanding . '/' . $thisReputation->maxStanding; ?>
                </span>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="col-md-3">

    </div>
</div>