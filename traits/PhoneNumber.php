<?php

trait PhoneNumber{
    public function formatPhoneNumber($phoneNumber){

       return "tel.". implode(" ",str_split($phoneNumber,3));

    }
}