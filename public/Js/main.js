 $.ajax({
    url: '/filter',
    type: 'POST',
    data: { year: year, mileage: mileage, make: make },
    success: function(response) {
      // Update the list of cars with the filtered results.
      $('#cars').html(response);
    }
  });