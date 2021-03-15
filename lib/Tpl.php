<?php

class Tpl {

    static public function view($tpl, $data = null) {
        ob_start();
        $tpl = preg_replace('/\./', '/', $tpl);
        require_once "view/$tpl.php";
        $content = ob_get_contents();
        //file_put_contents('/temp.html', $content);
        ob_end_clean();
        echo $content;
    }

}
