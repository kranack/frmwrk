<?php

class TestController extends Controller {

  public function index () {
    //var_dump(headers_list());
    $this->__resp->add_header('content', 'txt');
    //var_dump(headers_list());
    print_r("test");
  }

}
