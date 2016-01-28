<?php
namespace App\Common;
interface Crud {

    function create(\Object $request);

    function read(\Object $request);

    function update(\Object $request);

    function delete(\Object $request);
}

?>