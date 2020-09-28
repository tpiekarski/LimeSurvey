<li>
    <?php if ($button->isDropDown()) : ?>
        <div class="topbarbuttongroup btn-group" href="#">
            <div class="topbardropdown">
                <div class="topbarbutton">
                    <?php $this->render('dropdown', ['button' => $button]); ?>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="topbarbutton">
            <a
                class="btn navbar-btn button  btn-default pjax btntooltip"
                href="<?= $button->getHref(); ?>">
                <?php if ($button->getIconClass()) : ?>
                    <i class="<?= $button->getIconClass(); ?>"></i>&nbsp;
                <?php endif; ?>
                <?= $button->getLabel(); ?>
            </a>
        </div>
    <?php endif; ?>
</li>
