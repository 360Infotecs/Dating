<?php
include_once("telerivet.php");
$API_KEY="2IrOU_WEWKmeyykxLxe7boJ2WBOw0lsmFRIx";
$project_id="PJ5ea64779e932c763	";
$tr = new Telerivet_API($API_KEY);
$project = $tr->initProjectById($project_id);
echo($API_KEY);
$sent_msg = $project->sendMessage(array(
'content' => "hello world", 
'to_number' => "+94756902268"
));

?>