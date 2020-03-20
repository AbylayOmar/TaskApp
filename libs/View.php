<?php

class View {
    public function render($viewScript) {
        require($viewScript);
    }
}