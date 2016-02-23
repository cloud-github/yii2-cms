<?php
/**
 * @date      23/2/2016
 * @time      5:03 AM
 * @author  Mahesh Joshi <mahesh.connectnepal@gmail.com>
 * @copyright Copyright (c) 2015 Yii2-cms
 * @license   http://www.yii2-cms.com/license/
 */

use yii\helpers\Url;
?>
<script id="template-upload" type="text/x-tmpl">
{% if (o.files) { %}
    {% for (var i=0, file; file=o.files[i]; i++) { %}
        <li class="fade media-item">
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                <div class="progress-bar progress-bar-success" style="width:0%;"></div>
            </div>
        </li>
    {% } %}
{% } %}
</script>
<script id="template-download" type="text/x-tmpl">
{% if (o.files) { %}
    {% for (var i=0, file; file=o.files[i]; i++) { %}
        {% if (file.media_icon_url) { %}
            <li class="media-item" data-id={%=file.id%} id={%=file.id%}>
                <div class="item">
                    <img src="{%=file.media_icon_url%}">
                    {% if(file.render_type != 'image') { %}<span class="media-description">{%=file.media_title%}</span>{% } %}
                    <span class="selected-check"><i class="fa fa-check"></i><span>
                </div>
            </li>
        {% } %}
    {% } %}
{% } %}
</script>
<script id="template-media-detail" type="text/x-tmpl">
    <h3><?= Yii::t('yii2-cms', 'MEDIA DETAILS') ?></h3>
    <div class="media">
        <div class="media-left">
            <img alt="{%=o.media_title%}" style="width: 80px; height: 80px;" src="{%=o.media_icon_url%}">
        </div>
        <div class="media-body">
            <h4 class="media-heading">{%=o.media_filename%}</h4>
            <div class="date">{%=o.media_date_formatted%}</div>
            <div class="file-size">{%=o.media_readable_size%}</div>
            <a id="delete-media" class="text-danger delete-media" href="#" data-url="{%=o.media_delete_url%}" data-id="{%=o.id%}"
                data-confirm="<?= Yii::t('yii2-cms', 'Are you sure want to do this?') ?>">
                <i class="glyphicon glyphicon-trash"></i> <?= Yii::t('yii2-cms', 'Delete') ?>
            </a>
        </div>
    </div>
</script>
<script id="template-media-form" type="text/x-tmpl">
    <form class="form-horizontal" action='<?= Url::to(['/site/forbidden']) ?>'
        data-id="{%=o.id%}" id="media-form-inner" method="post"
        data-update-url="<?php echo Url::to(['/media/ajax-update']) ?>">
        <input type="hidden" id="media-id" value="{%=o.id%}" name="id">
        <input type="hidden" id="media-media_type" value="{%=o.media_render_type%}" name="media_type">
        <div class="form-group">
            <label for="media-media_url" class="col-sm-4 control-label"><?= Yii::t('yii2-cms', 'URL') ?></label>
            <div class="col-sm-8">
                <input type="text" class="form-control input-sm" id="media-media_url" placeholder="url"
                    value="{%=o.media_versions.full.url%}" readonly="true" name="media_url">
            </div>
        </div>
        <div class="form-group">
            <label for="media-media_title" class="col-sm-4 control-label"><?= Yii::t('yii2-cms', 'Title') ?></label>
            <div class="col-sm-8">
                <input type="text" class="form-control input-sm" id="media-media_title" data-attr="media_title"
                    placeholder="Title" value="{%=o.media_title%}" name="media_title">
            </div>
        </div>
        <div class="form-group">
            <label for="media-media_excerpt" class="col-sm-4 control-label"><?= Yii::t('yii2-cms', 'Caption') ?></label>
            <div class="col-sm-8">
                <textarea class="form-control input-sm" id="media-media_excerpt" data-attr="media_excerpt"
                    placeholder="Caption" name="media_excerpt">{%=o.media_excerpt%}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="media-media_content" class="col-sm-4 control-label"><?= Yii::t('yii2-cms', 'Description') ?></label>
            <div class="col-sm-8">
                <textarea class="form-control input-sm" id="media-media_content" data-attr="media_content"
                    placeholder="Descrption" name="media_content">{%=o.media_content%}</textarea>
            </div>
        </div>
        <h4><?= Yii::t('yii2-cms', 'MEDIA DISPLAY SETTINGS') ?></h4>
        {% if (o.media_render_type == 'image') { %}
            <div class="form-group">
                <label for="media-media_alignment" class="col-sm-4 control-label">
                    <?= Yii::t('yii2-cms', 'Alignment') ?>
                </label>
                <div class="col-sm-8">
                    <select class="form-control input-sm" id="media-media_alignment" name="media_alignment">
                        <option value="align-left"><?= Yii::t('yii2-cms', 'Left') ?></option>
                        <option value="align-center"><?= Yii::t('yii2-cms', 'Center') ?></option>
                        <option value="align-right"><?= Yii::t('yii2-cms', 'Right') ?></option>
                        <option value="align-none"><?= Yii::t('yii2-cms', 'None') ?></option>
                    </select>
                </div>
            </div>
        {% } %}
        <div class="form-group">
            <label for="media-media_link_to" class="col-sm-4 control-label">
                <?= Yii::t('yii2-cms', 'Link To') ?>
            </label>
            <div class="col-sm-8">
                <select class="form-control input-sm" id="media-media_link_to" name="media_link_to">
                    <option value="{%=o.media_view_url%}"><?= Yii::t('yii2-cms', 'Media') ?></option>
                    <option value="<?= Yii::$app->urlManagerFront->baseUrl . '/uploads/' ?>{%=o.media_versions.full.url%}">File</option>

                    {% if (o.media_render_type == 'image') { %}
                        <option value="custom"><?= Yii::t('yii2-cms', 'Custom URL') ?></option>
                        <option value="none"><?= Yii::t('yii2-cms', 'None') ?></option>
                    {% } %}

                </select>
                <input type="text" class="form-control input-sm" id="media-media_link_to_value" placeholder="Link to"
                    value="{%=o.media_view_url%}" style="margin-top: 2px;" readonly="true" name="media_link_to_value">
            </div>
        </div>
        {% if (o.media_render_type == 'image') { %}
            <div class="form-group">
                <label for="media-media_size" class="col-sm-4 control-label"><?= Yii::t('yii2-cms', 'Size') ?></label>
                <div class="col-sm-8">
                    <select class="form-control input-sm" id="media-media_size" name="media_size">
                        {% for (var i=0; i<o.media_size.length; i++) { %}
                            <option value="{%=o.media_size[i].version%}">
                                {%=o.media_size[i].version%} {%=o.media_size[i].width%}x{%=o.media_size[i].height%}
                            </option>
                        {% } %}
                    </select>
                </div>
            </div>
        {% } %}
    </form>
</script>
