<?php

namespace app\models;

class Message {
  private $from;
  private $to;
  private $mesubjectssage;
  private $message;

  public function __construct($from, $to, $subject, $message) {
    $this->from = $from;
    $this->to = $to;
    $this->message = $message;
  }

  public function getTo() {
    return $this->to;
  }

  public function getFrom() {
    return $this->from;
  }

  public function getMessage() {
    return $this->message;
  }

  public function setTo($to) {
    $this->to = $to;
  }

  public function setFrom($from) {
    $this->from = $from;
  }

  public function setMessage($message) {
    $this->message = $message;
  }

  public function send() {
    $header = "FROM: " . $from->getEmail();
    mail($to->getEmail(), $subject, $message, $headers);
  }

}

?>