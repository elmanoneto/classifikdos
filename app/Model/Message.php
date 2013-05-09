<?php
class Message extends AppModel {
    public $hasMany = array(
        'Video' => array(
            'className' => 'Attachment',
            'foreignKey' => 'foreign_key',
            'conditions' => array(
                'Attachment.model' => 'Message',
            ),
        ),
    );
}
?>