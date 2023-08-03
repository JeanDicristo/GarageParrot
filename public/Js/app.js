$(document).ready(function() {
    // Get the filter form
    const filterForm = $("#filter-form");
  
    // When the filter form is submitted, send an AJAX request
    filterForm.submit(function(e) {
      e.preventDefault();
  
      // Get the values from the filter form
      const year = $("#year").val();
      const brand = $("#brand").val();
  
      // Send an AJAX request to the CarController
      $.ajax({
        url: "/ajax/occasion/filter",
        type: "POST",
        data: {
            year: year,
            brand: brand
        },
        success: function(response) {
            const carsContainer = $(".offres");
            carsContainer.html(""); // Clear the existing cars
        
            response.cars.forEach(car => {
                const carHtml = `
                    <!-- Your car card HTML here using car data -->
                `;
                carsContainer.append(carHtml);
            });
        }
    });
    });
  });