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
        });
    });

    document.getElementById('submit_review').addEventListener('click', function() {
        const foodRating = document.getElementById('food_rating').querySelector('.star[style="color: goldenrod"]').getAttribute('data-rating');
        const interfaceRating = document.getElementById('interface_rating').querySelector('.star[style="color: goldenrod"]').getAttribute('data-rating');
        const orderingRating = document.getElementById('ordering_rating').querySelector('.star[style="color: goldenrod"]').getAttribute('data-rating');
        const comment = document.getElementById('comment').value;

        // Send the ratings and comment to the server for processing
        console.log('Food Rating:', foodRating);
        console.log('Interface Rating:', interfaceRating);
        console.log('Ordering Rating:', orderingRating);
        console.log('Comment:', comment);
    });
});
