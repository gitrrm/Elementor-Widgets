jQuery(document).ready(function($) {
    function moveCategory() {
        var babeAddonsCategory = $('#elementor-panel-category-babe_addons');
        var basicCategory = $('#elementor-panel-category-basic');
        
        if (babeAddonsCategory.length && basicCategory.length) {
            babeAddonsCategory.insertAfter(basicCategory);
        } else {
            // Retry after a short delay if categories are not found yet
            setTimeout(moveCategory, 100);
        }
    }

    // Wait until Elementor panel is fully initialized
    $(document).on('elementor:init', function() {
        setTimeout(moveCategory, 2000); // Adjust delay if needed
    });
});
