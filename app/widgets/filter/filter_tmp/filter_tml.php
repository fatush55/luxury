<div class="row">
    <div class="col-5 col-sm-3">
        <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
            <?php $i = 1;
            foreach ($this->groups as $group_id => $group_item): ?>
                <a class="nav-link <?= $i === 1 ? 'active' : '' ?>" id="vert-tabs-<?= $group_id ?>-tab"
                   data-toggle="pill" href="#vert-tabs-<?= $group_id ?>" role="tab"
                   aria-controls="vert-tabs-<?= $group_id ?>"
                   aria-selected=" <?= $i === 1 ? 'true' : 'false' ?>">
                    <?= $group_item ?>
                </a>
                <?php $i++; endforeach; ?>
        </div>
    </div>

    <div class="col-7 col-sm-9">
        <div class="tab-content reset_attr" id="vert-tabs-tabContent">
            <?php $j = 1;
            foreach ($this->groups as $group_id => $group_item): ?>
                <?php if (!empty($this->attributes[$group_id])): ?>
                    <div class="tab-pane <?= $j === 1 ? 'text-left fade show active' : 'fade text-left' ?>"
                         id="vert-tabs-<?= $group_id ?>" role="tabpanel"
                         aria-labelledby="vert-tabs-<?= $group_id ?>-tab">
                        <div class="row">
                            <div class="col col-md-9">
                                <ul style="list-style: none; ">
                                    <?php foreach ($this->attributes[$group_id] as $attr_id => $value): ?>
                                        <?php
                                        if (!empty($this->filter) && in_array($attr_id, $this->filter)) {
                                            $checked = ' checked';
                                        } else {
                                            $checked = null;
                                        }
                                        ?>
                                        <li>
                                            <input type="radio" <?= $checked; ?> name="attr[<?= $group_id ?>]"
                                                   id="radio-<?= $attr_id ?>" value=" <?= $attr_id ?>" >
                                            <label for="radio-<?= $attr_id ?>">
                                                <i></i><?= $value ?>
                                            </label>

                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php $j++; endforeach; ?>
        </div>
    </div>
</div>