<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="row">

        </div>
        <table class="table table-condensed table-striped" style="text-align:center;">
            <thead>
            <tr>
                <th style="text-align:center;">Faction</th> <!-- tables.less explicitly defines th as left-aligned which is rather annoying -->
                <th style="text-align:center;">Standing</th>
                <th style="text-align:center;">Reputation</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($reputations as $thisReputation) { ?>

                <tr>
                    <td><?php echo $thisReputation->name; ?></td>
                    <td><?php echo $thisReputation->standingName; ?></td>
                    <td>
                        <div class="progress">
                            <div class="progress-bar progress-bar-<?php echo $thisReputation->barClass; ?>" role="progressbar" aria-valuenow="<?php echo round($thisReputation->calcStanding / $thisReputation->maxStanding * 100); ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round($thisReputation->calcStanding / $thisReputation->maxStanding * 100);?>%">
                <span>
                    <?php echo $thisReputation->calcStanding . '/' . $thisReputation->maxStanding; ?>
                </span>
                            </div>
                        </div>
                    </td>
                </tr>


            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
