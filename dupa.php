<form class="note-form" action="" method="post">
            <ul>
                <li>
                    <label>Tytuł <span class="required">*</span></label>
                    <input type="text" name="title" class="field-long" value="<?php echo htmlspecialchars($_POST['title']) ?? "" ?>" />
                </li>
                <li>
                    <label>Treść</label>
                    <textarea name="description" id="field5" class="field-long field-textarea" ><?php echo $_POST['description'] ?? "" ?></textarea>
                </li>
                <li>
                    <input type="submit" value="Submit" />
                </li>
            </ul>
        </form>