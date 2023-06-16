$(document).ready(function() {
  // Function to handle class changes on window resize
  function handleClassChanges() {
      var screenWidth = $(window).width();
      
      // Check if screen width is less than or equal to 768 pixels
      if (screenWidth <= 768) {
          // Remove the 'left-border-radius' class from '.card'
          $('.card.left-border-radius').removeClass('left-border-radius');
          $('.small-view').removeClass('d-none');
      } else {
          // Add the 'left-border-radius' class to '.card'
          $('.card').addClass('left-border-radius');
          $('.small-view').addClass('d-none');
      }
  }


  // Function to handle class changes on input/select change
  function handleInputValueChange() {
    $('input, select').each(function() {
        if ($(this).val().trim() !== '') {
            $(this).addClass('has-value');
        } else {
            $(this).removeClass('has-value');
        }
    });
  }
        
  // Call the function on input/select change
  $('input, select').change(function() {
      handleInputValueChange();
  });
  
  // Call the function on page load
  handleInputValueChange();
  
  // Call the function on page load
  handleClassChanges();
  
  // Call the function on window resize
  $(window).resize(function() {
      handleClassChanges();
  });
});



$(document).ready(function() {
    // Variables
    var currentStep = 1;
    var totalSteps = $(".tab-pane").length;

    // Show/hide steps
    function showStep(stepNumber) {
      $(".tab-pane").removeClass("show active");
      $("#step-" + stepNumber).addClass("show active");
      $(".prev-step").toggleClass("d-none", stepNumber === 1);
      $(".next-step").toggleClass("d-none", stepNumber === totalSteps);
    }

    // Next button click event
    $(".next-step").click(function() {
      if (currentStep < totalSteps) {
        currentStep++;
        showStep(currentStep);
      }
    });

    // Prev button click event
    $(".prev-step").click(function() {
      if (currentStep > 1) {
        currentStep--;
        showStep(currentStep);
      }
    });
  });