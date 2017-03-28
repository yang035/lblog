<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/28
 * Time: 11:45
 */

namespace App\Services;

//use Michelf\SmartyPants;
use Michelf\SmartyPants;
use Michelf\MarkdownExtra;


class Markdowner
{
    public function toHTML($text)
    {
        $text = $this->preTransfromText($text);
        $text = MarkdownExtra::defaultTransform($text);
        $text = SmartyPants::defaultTransform($text);
        $text = $this->postTransfromText($text);
        return $text;
    }

    public function preTransfromText($text)
    {
        return $text;
    }

    public function postTransfromText($text)
    {
        return $text;
    }
}