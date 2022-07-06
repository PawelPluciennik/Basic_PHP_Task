<?php
class Str {
    private string $string;
   
    function __construct(string $name) {
        $this->$string = $name;
    }

    function formatData(): string {
        return ucfirst($string);
    }
}
?>