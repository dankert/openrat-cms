page
	form
		window name:GLOBAL_PROP
			row
				cell class:fx
					text text:TEMPLATE_NAME
				cell class:fx
					input name:name
			row
				cell colspan:2
					button type:ok

RAW
<!--
<tr>
  <th colspan="2"><?php echo lang('GLOBAL_PAGES') ?></th>
</tr>

<?php $f1=true;
      foreach( $pages as $id=>$p )
      { ?>
<tr>
<td class="f1"><a href="<?php echo $p['url'] ?>" target="cms_main"><img src="<?php echo $image_dir.'icon_page'.IMG_EXT ?>" border="0" align="left"><?php echo $p['name'] ?></a></td>
</tr>
<?php }
      if ( count($pages)==0)
      { ?>
<tr>
<td class="f1"><?php echo lang('GLOBAL_NOT_FOUND') ?></td>
</tr>
<?php } ?>
  

</table>


</center>
-->
END

	focus field:name