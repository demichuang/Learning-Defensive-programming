<?php
require_once("SomeObject.php");

class DefensivePractice
{
    // 只有$object為null時，程式才不會出現錯誤(在參數區宣告預設值只能為null)
    public function checkObjectType(SomeObject $object = null)
    {
        $object = $object ? "Not null" : new SomeObject;
        $object->checkType();
    }

    // $int需在function內判斷，如要在參數區判斷，只能設為null
    public function checkIntType($int)
    {
        if (is_int($int)) {
            echo "Check Int type succeed!<br>";
        }

        if (!is_int($int)) {
            echo "Check Int type failed!<br>";
        }
    }


    public function checkChange($array = array())
    {
        if (!($array instanceof SomeObject)) {
            $array = new SomeObject;
        }

        var_dump($array->get('dd'));
    }
}

$test = new DefensivePractice();

$test->checkObjectType();
$test->checkObjectType(null);

$test->checkIntType(66);
$test->checkIntType(null);

$test->checkChange();
