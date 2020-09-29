<button
    type="button"
    class="btn btn-default navbar-btn button dropdown-toggle"
    data-toggle="dropdown"
    aria-haspopup="true"
    aria-expanded="false"
    >
    <?php if ($button->getIconClass()) : ?>
        <i class="<?= $button->getIconClass(); ?>"></i>&nbsp;
    <?php endif; ?>
    <?= $button->getLabel(); ?>
    &nbsp;
    <i class="caret"></i>
</button>
<ul class="dropdown-menu" role="menu">
    <?php foreach ($button->getMenuItems() as $menuItem) : ?>
        <?php if ($menuItem->hasPermission()) : ?>
            <?php if ($menuItem->isDivider()) : ?>
                <li class="divider"></li>
            <?php elseif ($menuItem->isSmallText()) : ?>
                <li class="dropdown-header"><?= $menuItem->getLabel(); ?></li>
            <?php else : ?>
                <li>
                    <a href="<?= $menuItem->getHref(); ?>">
                        <!-- Spit out icon if present -->
                        <?php if ($menuItem->getIconClass() != '') : ?>
                          <i class="<?= $menuItem->getIconClass(); ?>">&nbsp;</i>
                        <?php endif; ?>
                        <?= $menuItem->getLabel(); ?>
                    </a>
                </li>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
</ul>
