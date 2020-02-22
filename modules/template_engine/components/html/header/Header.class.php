<?php

namespace template_engine\components;

use template_engine\components\html\Component;
use template_engine\element\Element;

class HeaderComponent extends Component
{
    public $views;

    public function createElement()
	{
		return new Element(null);
	}

	public function begin()
    {
        if(false) // DEACTIVATED
        if (isset($this->views)) {
            echo '<div class="headermenu">';

            foreach (explode(',', $this->views) as $view) {
                echo '<div class="toolbar-icon clickable">';
                echo '<a href="javascript:void(0);" title="<?php echo lang(\'MENU_' . strtoupper($view ). '\') ?>" data-type="dialog" data-name="<?php echo lang(\'MENU_' . strtoupper($view ). '\') ?>" data-method="' . $view . '">';
                echo '<img src="./themes/default/images/icon/action/' . $view . '.svg" title="<?php echo lang(\'MENU_' . $view . '_DESC\') ?>" /><?php echo lang(\'MENU_' . $view . '\') ?>';
                echo '</a>';
                echo '</div>';
            }
            echo '</div>';

        }

    }
}


?>