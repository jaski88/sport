<?php
namespace app\widgets;

class Panel {

    static function begin($params = array( )) {
        $str = '<div class="panel panel-default">';
        if (isset($params['title'])) {
            $str .= '<div class="panel-heading">' . $params['title'] . '</div>';
        }
        $str .= '<div class="panel-body">';
        return $str;
    }

    static function end() {
        return '</div></div>';
    }

}
