<?php
class Post extends AppModel {
    public $hasMany = array(
        'Image' => array(
            'className' => 'Attachment',
            'foreignKey' => 'foreign_key',
            'conditions' => array(
                'Attachment.model' => 'Post',
            ),
        ),
    );
}
?>