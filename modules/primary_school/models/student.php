<?php

class Student extends DataMapper {

    var $has_one = array('user','grade');
	var $auto_populate_has_one = TRUE;
	var $has_many = array('enrollment','guardian');
	
	var $validation = array(		
		'alternate_id' => array(
            'label' => 'Alternate ID',
            'rules' => array('xss_clean', 'trim')
        )
	);
	
}

/* End of file student.php */
/* Location: ./application/models/student.php */