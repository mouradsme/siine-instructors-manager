<?php

    use App\Models\Category;

    function getCategoryById($id) {
        return Category::find($id);

    }

?>
