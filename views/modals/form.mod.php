<form enctype="multipart/form-data" id="<?php echo $config["options"]["id"]; ?>" class="<?php echo $config["options"]["class"]; ?>" method="<?php echo $config["options"]["method"]; ?>" action="<?php echo $config["options"]["action"]; ?>"  >
    <?php foreach ($config["struct"] as $element):?>
        <?php if($element["fieldset"] != ""): ?>
            <fieldset>
            <legend><?php echo $element["fieldset"]; ?></legend>
        <?php endif; ?>

        <?php foreach ($element["elements"] as $name => $attributs):?>
            <div class="form-row">
                <label for="<?php echo $attributs["id"]; ?>"><?php echo $attributs["label"]; ?></label>
                <?php if($attributs["type"] == "email"): ?>
                    <input id="<?php echo $attributs["id"]; ?>" type="<?php echo $attributs["type"]; ?>" name="<?php echo $name; ?>"
                           placeholder="<?php echo $attributs["placeholder"]; ?>" <?php if (isset($attributs["value"])) echo "value='".$attributs["value"]."'" ?>
                        <?php echo ($attributs["required"])?"required":"" ?>
                    >
                <?php elseif($attributs["type"] == "password"):?>
                    <input id="<?php echo $attributs["id"]; ?>" type="<?php echo $attributs["type"]; ?>" name="<?php echo $name; ?>"
                           placeholder="<?php echo $attributs["placeholder"]; ?>"  <?php if (isset($attributs["value"])) echo "value='".$attributs["value"]."'" ?>
                        <?php echo ($attributs["required"])?"required":"" ?>
                    >
                <?php elseif($attributs["type"] == "text"):?>
                    <input id="<?php echo $attributs["id"]; ?>" type="<?php echo $attributs["type"]; ?>" name="<?php echo $name; ?>"
                           placeholder="<?php echo $attributs["placeholder"]; ?>" <?php if (isset($attributs["value"])) echo 'value="'.$attributs["value"].'"' ?>

                        <?php echo ($attributs["required"])?"required":"" ?>
                    >
                <?php elseif($attributs["type"] == "textarea"):?>
                    <textarea id="<?php echo $attributs["id"]; ?>" name="<?php echo $name; ?>"
                              placeholder="<?php echo $attributs["placeholder"]; ?>"
                        <?php echo ($attributs["required"])?"required":"" ?>
                        <?php echo ($attributs["readonly"])?"readonly":"" ?>
                    ><?php echo $attributs["text"]; ?></textarea>
                <?php elseif($attributs["type"] == "checkbox"):?>
                    <input id="<?php echo $attributs["id"]; ?>" type="<?php echo $attributs["type"]; ?>" name="<?php echo $name; ?>"
                        <?php echo ($attributs["required"])?"required":"" ; echo ($attributs["checked"])?"checked":"" ?>
                    >
                <?php elseif($attributs["type"] == "file"):?>
                    <input id="<?php echo $attributs["id"]; ?>" type="<?php echo $attributs["type"]; ?>" name="<?php echo $name; ?>"
                        <?php echo ($attributs["required"])?"required":"" ?>
                    >
                <?php elseif($attributs["type"] == "select"):?>
                    <select <?php if(isset($attributs["multiple"]) && $attributs["multiple"]): ?>multiple<?php endif; ?> id="<?php echo $attributs["id"]; ?>" name="<?php echo $name; ?>">
                        <?php
                        foreach ($attributs["option"] as $option):?>
                            <option value="<?php echo $option['value']; ?>" <?php if($option['selected']): ?>selected<?php endif; ?>><?php echo $option['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
                <?php if(isset($attributs["extra"])): ?>
                    <div><?php echo $attributs["extra"]; ?> </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        <?php if($element["fieldset"] != ""): ?>
            </fieldset>
        <?php endif; ?>
    <?php endforeach; ?>

    <div class="form-row">
        <?php if(isset($config["options"]["submit"])): ?>
            <input class="submit" type="submit" name="" value="<?php echo $config["options"]["submit"]; ?>">
        <?php endif; ?>
        <?php if(isset($config["options"]["button"])): ?>
            <button class="submit" type="button" name=""><?php echo $config["options"]["button"]; ?></button>
        <?php endif; ?>
    </div>
</form>
