<?php
namespace App\Common;
interface Crud {

    function create($request);

    function read($request);

    function update($request);

    function delete($request);
}

?>