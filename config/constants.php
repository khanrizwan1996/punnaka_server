<?php

date_default_timezone_set('Asia/Kolkata');
//define('CURRENT_YEAR', date('Y'));
define('CURRENT_MONTH_DATE', date("m-d"));
define('CURRENT_DATE_MONTH', date("d-m"));
define('CURRENT_DATE', date("Y-m-d"));
define('CURRENT_DATE_MONTH_YEAR', date("d-m-Y"));
define('CURRENT_DATE_TIME', date("Y-m-d H:i:s"));
define('CURRENT_TIME', date('H:i'));
define('CURRENT_TIME_WITH_SECOND', date('H:i:s'));
define('CURRENT_DATE_TIME_SECOND', date("Y-m-d H:i:s"));
define('CURRENT_TIMESTAMP', time());

define('IMAGE_FOLDER_PATH', 'public/custom-images/images-folder');



define('USER_ADMIN_URL','user-admin/');
define('ADMIN_URL','admin/');


define('TYPE_BLOG','100');
define('TYPE_BUSINESS_LISTING','101');
define('TYPE_PRODUCT_SEVICE','102');
define('TYPE_IMAGE','1');
define('TYPE_ID_PROOF','2');




//////////////// Size //////
define('AUDIO_SIZE', '10');
define('IMAGE_SIZE', '5');
define('DOCUMENTS_SIZE', '2');
define('PDF_SIZE', '2');
define('EXCEL_SIZE', '2');
define('VIDEO_SIZE', '10');
define('ATTACHMENT_SIZE', '10');

///// FORMATES VALIDATION //////////////
define('JPG_PNG_FORMATES','["jpg","jpeg","png","PNG","JPG","JPEG"]');
define('ONLY_JPG_FORMATES','["jpg","jpeg","JPG","JPEG"]');
define('ONLY_PNG_FORMATES','["png","PNG"]');
define('ONLY_DOCUMENTS_FORMATES','["doc","docx","DOC","DOCX"]');
define('ONLY_PDF_FORMATES','["pdf","PDF"]');
define('ONLY_AUDIO_FORMATES','["mp3"]');
define('ONLY_VIDEO_FORMATES','["3gp,mp4"]');
define('ONLY_EXCEL_FORMATES','["xlsx","xls"]');
define('ATTACHMENT_FORMATES','["jpg","jpeg","png","PNG","JPG","JPEG","pdf","PDF","xlsx","xls"]');


//// STATUS
define('STATUS_INACTIVE',"0");
define('STATUS_ACTIVE',"1");
define('STATUS_DUPLICATE',"2");
define('STATUS_EXPIRED',"3");


//// ADMIN MESSAGES
define('MSG_ADD_SUCCESS',"100");
define('MSG_ADD_ERROR',"101");

define('MSG_PASSWORD_UPDATE_SUCCESS',"600");
define('MSG_PASSWORD_UPDATE_ERROR',"601");


define('MSG_UPDATE_SUCCESS',"200");
define('MSG_UPDATE_ERROR',"201");

define('MSG_IMAGES_ADD',"300");
define('MSG_IMAGES_ERROR',"301");

define('MSG_ALREADY_EXIST',"403");
define('MSG_NOT_FOUND',"404");

define('MSG_DELETE_SUCCESS',"500");
define('MSG_DELETE_ERROR',"501");

define('MSG_ALREADY_REGISTER',"601");
define('MSG_INVALID_CREDENTIALS',"701");

define('URL',env('APP_URL'));
define('NOT_FOUND_IMAGE_PATH',URL."custom-images/404-img.jpg");
?>
