<?php
namespace products\car;
interface CarInterface
{
    public function setColor($color);
    public function setMaxSpeed($maxSpeed);
    public function setTransmition($transmition);
}