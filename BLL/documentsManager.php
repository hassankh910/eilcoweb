<?php
require(__DIR__."/../DAL/documentsRepository.php");

function getDocument($cours_id){
    return getDocumentsByCours($cours_id);
}
function deleteDocument($iddoc,$doclink) {
    unlink(__DIR__."/../DAL/uploadeddocuments/" . $doclink);
    return deleteDocumentById($iddoc);
}
function addDocument($doc){
    return addDoc($doc);
}
function download($filepath){
    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        readfile($filepath);
    }
}
