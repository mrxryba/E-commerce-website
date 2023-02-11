<?php

trait HtmlEntitiesConvert
{
    public function convertToHtmlEntities(string $string){
        return htmlentities($string);
    }
}