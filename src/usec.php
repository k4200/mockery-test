<?php
require_once(__DIR__ . '/c.php');

class UseC1 {
    protected $c = null;
    public function __construct() {
        $c = new C1;
    }
    protected function getC() {
        return $this->c;
    }
    protected function proxyFoo() {
        return $this->getC()->foo();
    }
}

class UseC2 extends UseC1 {
    public function __construct() {
        $c = new C2;
    }
    protected function proxyBar() {
        return $this->getC()->bar();
    }
    public function complexFunction() {
        if ($this->getC()->foo()) {
            return $this->getC()->bar();
        }
    }
}
