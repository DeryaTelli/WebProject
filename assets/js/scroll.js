document.addEventListener('DOMContentLoaded', (event) => {
    const gallery = document.querySelector('.gallery');
    const scrollAmount = 300;

    document.querySelector('.scroll-button.left').addEventListener('click', () => {
        gallery.scrollBy({
            left: -scrollAmount,
            behavior: 'smooth'
        });
    });

    document.querySelector('.scroll-button.right').addEventListener('click', () => {
        gallery.scrollBy({
            left: scrollAmount,
            behavior: 'smooth'
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const searchBox = document.querySelector('.search-box input[type="text"]');
    const searchButton = document.querySelector('.search-box button');
    const galleryItems = document.querySelectorAll('.gallery .item');
    
    searchButton.addEventListener('click', function() {
        const searchTerm = searchBox.value.toLowerCase();
        
        galleryItems.forEach(item => {
            const title = item.querySelector('p').innerText.toLowerCase();
            const imageName = item.querySelector('img').getAttribute('alt').toLowerCase();
            
            if (title.includes(searchTerm) || imageName.includes(searchTerm)) {
                item.classList.add('highlight');
                item.scrollIntoView({ behavior: 'smooth', block: 'center' });
            } else {
                item.classList.remove('highlight');
            }
        });
    });
});
