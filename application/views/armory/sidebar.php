<div class="row">
    <div class="col-md-3"><ul>
            <h2><a href="<?php echo site_url(); ?>"?>Armory</a></h2>
            <li>Global Nav Goes Here</li>
        </ul></div>
    <div class="col-md-6" style="text-align:center;">
        <h1><?php echo $characterName; ?></h1>
        <h2><?php echo $level . ' ' . $raceName . ' ' . $className; //TODO add spec ?></h2>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-md-offset-3" role="navigation">
        <nav>
            <ul class="nav nav-tabs nav-justified">
                <li role="presentation"> <!-- class="active" for active tab --><a href="<?php echo site_url(); ?>/armory/characterOverview/<?php echo $characterName; ?>">Overview</a></li>
                <li role="presentation"><a href="<?php echo site_url(); ?>/armory/characterReputation/<?php echo $characterName; ?>">Reputation</a></li>
                <li role="presentation" class="disabled"><a href="<?php echo site_url(); ?>/armory/characterTalents/<?php echo $characterName; ?>">Talents</a></li>
                <li role="presentation" class="disabled"><a href="<?php echo site_url(); ?>/armory/characterAchievements/<?php echo $characterName; ?>">Achievements</a></li>
                <li role="presentation" class="disabled"><a href="<?php echo site_url(); ?>/armory/characterHonor/<?php echo $characterName; ?>">Honor</a></li>
            </ul>
        </nav>
    </div>
</div>

<!-- TODO kick out the character nav into its own view, then js ajax for content load -->