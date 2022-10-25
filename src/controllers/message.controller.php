<?php 
    include_once "{$_SERVER['DOCUMENT_ROOT']}/{$_ENV['SRC_DIR']}" . '/services/message.service.php';

    class MessageController {

        public static function indexByCurriculum($id) {
            return Message::indexByCurriculum($id);
        }

        public static function indexByUser($id) {
            return Message::indexByUser($id);
        }

        public static function create($curriculum_id, $user_id, $first_name, $last_name, $email, $phone, $subject, $msg) {
            $message = new Message();
            $message->curriculum_id = $curriculum_id;
            $message->user_id = $user_id;
            $message->first_name = $first_name;
            $message->last_name = $last_name;
            $message->email = $email;
            $message->phone = $phone;
            $message->subject = $subject;
            $message->message = $msg;


            return $message->create();
        }

    }