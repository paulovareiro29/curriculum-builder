<?php 
    include_once "{$_SERVER['DOCUMENT_ROOT']}/{$_ENV['SRC_DIR']}" . '/services/contact.service.php';

    class ContactController {

        public static function indexByCurriculum($id) {
            return Contact::indexByCurriculum($id);
        }

        public static function indexByUser($id) {
            return Contact::indexByUser($id);
        }

        public static function create($curriculum_id, $user_id, $first_name, $last_name, $email, $phone, $message) {
            $contact = new Contact();
            $contact->curriculum_id = $curriculum_id;
            $contact->user_id = $user_id;
            $contact->first_name = $first_name;
            $contact->last_name = $last_name;
            $contact->email = $email;
            $contact->phone = $phone;
            $contact->message = $message;


            return $contact->create();
        }

    }