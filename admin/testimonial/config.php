<?php
//**Note: All Values must be in Capital Letters otherwise values will not be accepted by the Script**
//**Note: Images will be saved as e.g "imageprefix_1.png", where imageprefix you can set below and image count will get on incresing as you go on uploading**
//**Note: Please make sure that the folder names defined below are available and corrected to the their defined path below

//Set the Image Prefix
define("IMAGE_PREFIX","Testi_");

//Set path of folder with respect to index.php where you want to save resulted cropped/resized images
define("PATH_CROP_RESIZED_IMG","../../img/testimonials/");

 //Set Default Save Type value as "CROP" or "RESIZE",No other value than this two!
define("DEFAULT_SAVE","CROP");

//Set crop image heright & width in px
define("CROPBOX_WIDTH",150);
define("CROPBOX_HEIGHT",150);

//Note:  For Resize:- for maintaining image's aspect ratio resulted resized image dimensions may vary even after defined set below !
//Set resize height & width in px
define("RESIZE_HEIGHT",150);
define("RESIZE_WIDTH",150);

//No. of images to be uploaded at once:-
//Value should be "SINGLE" or "MULTI",No other value than this two!
define("IMG_UPLOAD","SINGLE");
//Value should be greater than 0 with condition = valid only if "IMG_UPLOAD"="MULTI"
define("NUMBER_OF_IMG_UPLOAD",1);


//Set if you want to save resulted cropped/resized images in original image dimension value="YES" or value="NO",No other value than this two!
define("NEED_IN_ORIGINAL_SIZE","NO");

//Set path of folder with respect to index.php where you want to save cropped/resized image in original image dimensions
define("PATH_ORIGINAL_SIZE","../../img/testimonials/original/");


// "YES" or "NO" if value="YES" ,Prefix "DEL_" will be added to image name on delete..else if "NO" images will get deleted from folder
define("DEL_PREFIX","NO");


 ?>