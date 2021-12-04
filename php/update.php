<?php 
//Handles PATCH request to update issue status

function updateStatus($conn, $data){
    $status = $data["status"];
    $id = $data["_id"];
    $stmt = $conn->prepare("UPDATE `issues` SET status = '$status', updated = SYSDATE()  WHERE  id = '$id'");
    
    #Result stores TRUE if query successfully executed
    $result = $stmt->execute();

    return $result;
}
?>