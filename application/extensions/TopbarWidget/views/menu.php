<li>
    <div class="topbarbutton">
        <a
            class="btn navbar-btn button btn-default pjax btntooltip <?php if ($button->isDisabled()) { echo 'readonly'; } ?>"
            href="<?= $button->getHref(); ?>"
            title="<?= $button->getTooltip(); ?>"
            data-toggle="tooltip"
            data-placement="bottom"
        >
            <?php if ($button->getIconClass()) : ?>
                <i class="<?= $button->getIconClass(); ?>"></i>&nbsp;
            <?php endif; ?>
            <?= $button->getLabel(); ?>
        </a>
    </div>
</li>
