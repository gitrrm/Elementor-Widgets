// Bind to the 'elementor:init' event to ensure this code executes only when Elementor is initialized
jQuery(window).on('elementor:init', function() {
    // Wait for the DOM to be fully loaded before executing the code
    document.addEventListener('DOMContentLoaded', function() {
        // Global variable to store the selected categories
        var selectedCategories = [];

        /**
         * Function to load categories dynamically based on the selected post type.
         * Makes an AJAX request to fetch categories associated with a specific post type.
         * 
         * @param {string} postType - The post type selected by the user.
         */
        function loadCategoriesByPostType(postType) {
            // Perform an AJAX request
            $.ajax({
                url: ajax_object.ajax_url, // The AJAX URL provided by WordPress
                method: 'POST', // HTTP method
                data: {
                    action: 'get_post_type_categories', // WordPress action hook
                    post_type: postType, // Selected post type
                    nonce: ajax_object.nonce, // Security nonce
                },
                success: function(response) {
                    console.log("AJAX Response: ", response); // Debug: Log the AJAX response
                    if (response.success) {
                        var categoriesControl = $('select[data-setting="select_post_category"]');
                        categoriesControl.empty(); // Clear any existing options

                        // Populate the categories dropdown with the new data
                        $.each(response.data, function(key, value) {
                            var option = $('<option></option>').attr('value', key).text(value);
                            
                            // If the category was previously selected, mark it as selected
                            if (selectedCategories.includes(String(key))) {
                                option.prop('selected', true);
                            }
                            categoriesControl.append(option);
                        });

                        // Trigger a change event for any dependent logic
                        categoriesControl.trigger('change');
                    } else {
                        alert('Failed to fetch categories.'); // Notify the user in case of failure
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error: " + status + ": " + error); // Log any AJAX errors
                }
            });
        }

        /**
         * Event handler for post type selection changes.
         * Triggers the `loadCategoriesByPostType` function to load categories dynamically.
         */
        $(document).on('change', 'select[data-setting="select_post_type"]', function() {
            var selectedPostType = $(this).val(); // Get the selected post type
            loadCategoriesByPostType(selectedPostType); // Load categories for the selected post type
        });

        /**
         * Debugging handler for clicking on the specific Elementor widget.
         * Logs a message and prevents default actions.
         */
        $(document).on('click', '.elementor-widget-babe_featured_slider', function(e) {
            console.log('Widget clicked!'); // Debug message
            e.preventDefault(); // Prevent default behavior
            e.stopPropagation(); // Stop event propagation
        });

        /**
         * On page load, initialize categories for the pre-selected post type.
         * Uses a setInterval to ensure the required elements are loaded in the DOM.
         */
        var checkInterval = setInterval(function() {
            var initialPostType = $('select[data-setting="select_post_type"]').val(); // Get the initial post type
            selectedCategories = $('select[data-setting="select_post_category"]').val() || []; // Get preselected categories
            
            if (initialPostType) {
                loadCategoriesByPostType(initialPostType); // Load categories for the initial post type
                clearInterval(checkInterval); // Clear the interval once initialization is complete
            }
        }, 100); // Check every 100ms

        /**
         * Event handler for category selection changes.
         * Updates the global `selectedCategories` variable with the selected values.
         */
        $(document).on('change', 'select[data-setting="select_post_category"]', function() {
            selectedCategories = $(this).val() || []; // Update selected categories
        });

        /**
         * Restores selected categories when an Elementor widget container is rendered.
         * Useful for maintaining state during widget re-initializations.
         */
        $(document).on('elementor:widget:container:rendered', function(event) {
            selectedCategories = $('select[data-setting="select_post_category"]').val() || []; // Restore selected categories
        });
    });
});
