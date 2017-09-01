<?php

require_once('../../../../config.php');
require_once($CFG->dirroot . '/mod/quiz/accessrule/useripmapping/useripmapping_form.php');

global $CFG, $PAGE ,$DB;

$quizid = optional_param('quizid',0,PARAM_INT);

require_login();

$returnurl = new moodle_url('/mod/quiz/accessrule/useripmapping/test1.php');

$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('standard');
$PAGE->set_title('SIP Mapping List');
$PAGE->set_heading('View and Edit Student IP Mapping List');
$PAGE->set_url($CFG->wwwroot.'/mod/quiz/accessrule/useripmapping/test1.php');
echo $OUTPUT->header();

$mform = new quizaccess_view_edit_useripmapping_list();
$quizdata = array ('quizid' => $quizid);
$mform->set_data($quizdata);
$mform->display();
// $mform1 = new quizaccess_add_useripmapping();
if ($formdata = $mform->is_cancelled()) {	
	redirect($returnurl);	
} elseif ($data = $mform->get_data()) {
    
	$userid=$DB->get_fieldset_select('user', 'id','firstname = ?', array($data->username));	
	$select='quizid = '.$quizid.' AND userid IN ('.implode(',',$userid).')';
	$result = $DB->get_records_select('user_ip_mapping',$select);
	
	if( empty($result))
	{
		echo "No Records Found";
	}
	else 
	{
		$table = new html_table();

		
		echo "<p>To Edit,Click on IP Address field.</p>";
	
	
	$table->head = array('ID Number','Quiz ID','User ID', 'User Name','IP Address');

	foreach ($result as $record) {
		$studentname = $data->username;
		$ip = $record->ip;
		$quizid = $record->quizid;
		$userid=$record->userid;
		$studentid= $DB->get_field('user','idnumber', array('id'=>$userid));
		$row = new html_table_row();
		$cell0 = new html_table_cell($studentid);
		$cell1 = new html_table_cell($quizid);
		$cell2 = new html_table_cell($userid);
		$cell3 = new html_table_cell($studentname);		
		$cell4 = new html_table_cell($ip);
		$cell4->attributes['contenteditable'] = 'true';
		$row->cells[] = $cell0;
		$row->cells[] = $cell1;
		$row->cells[] = $cell2;
		$row->cells[] = $cell3;
		$row->cells[] = $cell4;		
		$table->data[] = $row;
	}
	
	echo html_writer::table($table);
	echo "<script>
alert('hi 1');
$($cell4).keypress(function(){
 alert('hi');
});

</script>";
// 	$mform1->display();
	}
	}
echo $OUTPUT->footer();
?>
<script>

$(function(){

	alert('hi');
	//acknowledgement message
    
//     $("td[contenteditable=true]").blur(function(){
//         alert('hi');
// //         var field_userid = $(this).attr("id") ;
// //         var value = $(this).text() ;
// //         $.post('ajax.php' , field_userid + "=" + value, function(data){
// //             if(data != '')
// // 			{
// // 				message_status.show();
// // 				message_status.text(data);
// // 				//hide the message
// // 				setTimeout(function(){message_status.hide()},3000);
// // 			}
// //         });
//     });
});

</script>