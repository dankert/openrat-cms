<label<?php if (isset($attr_for)) { ?> for="id_<?php echo $attr_for ?><?php if (!empty($attr_value)) echo '_'.$attr_value ?>" <?php if(hasLang(@$attr_key.'_desc')) { ?> title="<?php echo lang(@$attr_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($attr_key)) { echo lang($attr_key); ?><?php if (isset($attr_text)) { echo $attr_text; } ?><?php } ?>