<?php
class C1 {
    protected function foo() {
        return "C1#foo";
    }
    protected function insideFoo() {
        return 'insideFoo';
    }
}

class C2 extends C1 {
    protected function bar() {
        $this->insideBar();
        return "C2#bar";
    }
    protected function insideBar() {
        return 'insideBar';
    }
    protected function callFoo() {
        return $this->foo();
    }
}

