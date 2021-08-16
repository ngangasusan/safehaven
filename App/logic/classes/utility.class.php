<?php

    class Utility {
        public static $nameRegex = "/^[\w]+(\s?[\w\-_\'\.]+?\s*?)+?$/";
        public static $phoneRegex = "/^\+?\d{12}$/"; 
        public static $acceptedImages = ".jpg, .png, .bmp, .gif, .webp";
        const PRIME_NUMBER = 1879;
        public static $storagePath = "../../storage";
        
        
        /**
         * checks names to ensure that they meet policy
         */
        public static function checkName($name){
            if(preg_match(self::$nameRegex, $name)){
                return true;
            }
            return false;
        }

        /**
         * Checks the phone number against the legal regular expression for phone numbers
         */
        public static function checkPhone($phoneNumber){
            if(preg_match(self::$phoneRegex, $phoneNumber)){
                return true;
            }
            return false;
        }
      
         /**
          * Checks to verify that the email meets the requirement
          */
         public static function checkEmail($email){
             if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                return true;
             }
             return false;
         }

          /**
           * Checks if the password is a qualified password
           * @return string|bool PNE|PLLE|PULE|PLSE
           * Password Number Error: Password must include numbers
           * Password Lowercase Letter Error: Password must include lowercase letters
           * Password Uppercase Letter Error: Password must include uppercase letters
           * Password Length Short Error: Password must length is shorter then 9 characters.
           */

           public static function isPasswordStrong($password){
            if(strlen($password) < 9){
               return Response::make("PLE","Password must be longer than 9 characters");//Password Length Short Error
             }
             if(!preg_match('@[A-Z]@', $password))
             {
                return Response::make("PULE","Password must have at least one uppercase letter");//Password Uppercase Letter Errors   
             }
             if(!preg_match('@[a-z]@', $password))
             {
                return Response::make("PLLE","Password must have at least one lowercase letter"); //Password Lowercase Letter Error         
             }
             if(!preg_match('@[0-9]@', $password))
             {
                return Response::make("PNE", "Password must have at least one digit");//Password Number Error
             }
             return true;
            }


            /**
             * This function allows the uploading of images.
             * It takes the Image Array, the name of the image and the directory to place the image in.
             * When an image is given a name, the name is appended with a -uniqueId to make the image 
             * name unique. For example, a name user, after upload will be user-123a3bc4567c2.jpeg. 
             * All images are saved as a jpeg format. To retrieve an image, please use the returnImgSrc
             * function to give you the image source. This is because the unique Id after the image has
             * been uploaded makes it impossible to fetch it directly.
             * @param array $image - The image array from $_FILES
             * @param string $save_name - The name to save the image with
             * @param string $in_directory - The directory in which the image should be saved.
             * The directory will be autoloaded. So you don't have to worry about the ../. hehe. However
             * It must be in the storage directory.
             * @param bool $update = false. If you are updating a currently existing image, then
             * set this parameter to true. It will allow the method to delete the previously existing 
             * image and upload the new one.
             * 
             * Always change Utility::storagePath when you are not accessing the uploadImage from the procedures or classes 
             * folder.
             * @return bool
             */
            public static function uploadImage(array $image, $save_name, $in_directory, $update = false, $last_saved_as = ""){
            $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
            $ext = strtolower($ext);

            switch (exif_imagetype($image['tmp_name'])) {
                case IMAGETYPE_PNG:
                    $imageTmp=imagecreatefrompng($image['tmp_name']);
                    break;
                case IMAGETYPE_JPEG:
                    $imageTmp=imagecreatefromjpeg($image['tmp_name']);
                    break;
                case IMAGETYPE_GIF:
                    $imageTmp=imagecreatefromgif($image['tmp_name']);
                    break;
                case IMAGETYPE_BMP:
                    $imageTmp=imagecreatefrombmp($image['tmp_name']);
                    break;
                // Defaults to JPG
                default:
                    $imageTmp=imagecreatefromjpeg($image['tmp_name']);
                    break;
            }
        
            // quality is a value from 0 (worst) to 100 (best)
            $name = $save_name."-".uniqid().".jpeg";
            if(imagejpeg($imageTmp, Utility::$storagePath."/$in_directory/$name", 70)){
                imagedestroy($imageTmp);

                if($update && $last_saved_as != ""){
                    $oldImage = Utility::$storagePath ."/$in_directory/$last_saved_as";
                    if(file_exists($oldImage)){
                        unlink("$oldImage");
                    }  
                }
                
                return $name;
            }
            else{
                imagedestroy($imageTmp);
                return false;
            }
        }

            /**
             * Checks if an image is in an acceptable format.
             * The extensions are .jpg, .jpeg, .png, .bmp, .webp 
             * @param string $path path to the image. Usually it is the tmp_name in the $_FILES
             * @return bool
             */
             public static function isImage($path){
                $check = exif_imagetype($path);
                if(in_array($check, array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP, IMAGETYPE_WEBP))){
                    return true;
                }
                return false;
            }


            /**
             * Checks if an email exist already
            */
            public static function doesEmailExist($email){
                $dbmanager = New DbManager();
                $dbmanager->setFetchAll(true);
                $emailQuery = $dbmanager->query(DbManager::USER_TABLE, ["email"], "email = ? LIMIT 1", [$email]);
                
                if ($emailQuery === false || count($emailQuery) > 0) {
                    return true;
                }
                return false;
            }
            
            //Email Verification
            


             /**
              * Numbers formatter. This function formats numbers and return 4000 as 4k
              * from stackoverflow.
              */

             public static function thousandsCurrencyFormat($num) {

                if($num>1000) {
              
                      $x = round($num);
                      $x_number_format = number_format($x);
                      $x_array = explode(',', $x_number_format);
                      $x_parts = array('k', 'm', 'b', 't');
                      $x_count_parts = count($x_array) - 1;
                      $x_display = $x;
                      $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
                      $x_display .= $x_parts[$x_count_parts - 1];
              
                      return $x_display;
              
                }
              
                return $num;
              }

              /**
               * For encryption of numbers that will be visible in a url.
               * For example, the confirm email link
               * @param int $number
               * @return string
               */
             public static function letoBase29Encode($number){
                $newNum = $number * Utility::PRIME_NUMBER;
                $newNum **= 2;
                $newNum = base_convert($newNum, 10, 29);
                $newNum = base64_encode($newNum);
                return $newNum;
            }

            /**
             * Decodes a letoBase29Encoded number.
             * @param string $input;
             * @return int;
             */
            public static function letoBase29Decode($input){
                $origNum = base64_decode($input);
                $origNum = base_convert($origNum, 29, 10);
                $origNum = sqrt($origNum);
                return $origNum/Utility::PRIME_NUMBER;
            }

            public static function make6digitCode(){
                $code = "";
                for($i = 0; $i < 6; $i++)
                {
                    $code .= random_int(1, 9);
                }

                return $code;
            }

    }

?>