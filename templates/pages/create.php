<div>
    <h3> Nowa notatka </h3>
    <?=dump($params)?>
    <div>
        <form class="note-form" action="/?action=create" method="post">
            <ul>
                <li>
                    <label>Tytuł <span class="required">*</span></label>
                    <input type="text" name="title" class="field-long" value="<?php echo $params['title'] ?? "" ?>" />
                    <p style="color:red"><?php echo $params['error']['TitleError'] ?? "" ?></p>
                </li>
                <li>
                    <label>Treść</label>
                    <textarea name="description" id="field5" class="field-long field-textarea" ><?php echo $params['description'] ?? "" ?></textarea>
                    <p style="color:red"><?php echo $params['error']['DescriptionEmpty'] ?? "" ?></p>
                </li>
                <li>
                    <input type="submit" value="Submit" />
                </li>
            </ul>
        </form>
    </div>
</div>