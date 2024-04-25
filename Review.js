document.addEventListener('DOMContentLoaded', function() {
  const stars = document.querySelectorAll('.star');
  stars.forEach(star => {
    star.addEventListener('click', function() {
      const rating = this.getAttribute('data-rating');
      const parent = this.parentElement;
      const stars = parent.querySelectorAll('.star');
      stars.forEach(s => {
        if (parseInt(s.getAttribute('data-rating')) <= rating) {
          s.style.color = 'goldenrod';
        } else {
          s.style.color = 'black';
        }
      });
      parent.querySelector('input').value = rating; // Set the hidden input value
    });
  });

  document.getElementById('submitReview').addEventListener('click', function(e) {
      e.preventDefault(); // Prevent form submission
  
      const foodRating = document.getElementById('food_rating_input').value;
      const interfaceRating = document.getElementById('interface_rating_input').value;
      const orderingRating = document.getElementById('ordering_rating_input').value;
      const comment = document.getElementById('comment').value;
  
      // Prepare the form data
      const formData = new FormData();
      formData.append('food_rating', foodRating);
      formData.append('interface_rating', interfaceRating);
      formData.append('ordering_rating', orderingRating);
      formData.append('comment', comment);
  
      // Send the AJAX request
      fetch('submitreview.php', {
          method: 'POST',
          body: formData
      })
      .then(response => response.text())
      .then(data => {
          console.log('Server response:', data);
          // Redirect to 'thankyou.html' page
          window.location.href = 'thankyou.html';
      })
      .catch(error => {
          console.error('Error:', error);
          // Handle the error here
      });
  });
});