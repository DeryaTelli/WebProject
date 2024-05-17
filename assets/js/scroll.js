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
