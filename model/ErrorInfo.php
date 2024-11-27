<?php
class ErrorInfo {
    public string $module;
    public int $errorCode;
    public string $exception;

    public function __construct(string $mod, int $er, string $ex) {
        $this->module = $mod;
        $this->errorCode = $er;
        $this->exception = $ex;
    }
}
?>
