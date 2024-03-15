<?php

    use App\Models\Category;

    function getCategoryById($id) {
        return Category::find($id);

    }

    function status($status) {
        $statuses = array("En cours", "Approuvé");
        return $statuses[$status];
    }
?>
