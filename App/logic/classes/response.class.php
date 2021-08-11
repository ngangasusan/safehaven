<?php
    
    class Response{

        /**
         * Makes a JSON encoded message with two fields: status and message.
         * `{
         * status:$status, 
         * msg:$message
         * }`
         * @param string $status
         * @param string $message
         */
        public static function make($status, $message){
            return json_encode([
                "status"=>$status,
                 "msg"=>$message
            ]);
        }
        /**
         * SQL Error
         */
        public static function SQE(){
            return Response::make("SQE", "Message Error Ocurred"); 
        }
    }

?>