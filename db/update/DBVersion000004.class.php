<?php


/**
 * Add Columns for user language and user timezone.
 * 
 * @author dankert
 *
 */
class DBVersion000004 extends DbVersion
{
	public function update()
	{
		$not_nullable = false;
		$nullable     = true;
		
		// Add user language
		$this->addColumn('user','language','VARCHAR', 2,null,$nullable);
		
		// Add user timezone
		$this->addColumn('user','timezone','VARCHAR',64,null,$nullable);
		
	}
}

?>