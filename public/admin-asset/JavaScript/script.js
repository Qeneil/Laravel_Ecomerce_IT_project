document.addEventListener('DOMContentLoaded', () => {
    document.body.style.opacity = 1;

    const toggleButton = document.getElementById('toggleDrawer');
    const drawer = document.getElementById('drawer');
    const closeButton = document.getElementById('closeDrawer');
    const dropdownButton = document.getElementById('dropdownInformationButton');
    const dropdownMenu = document.getElementById('dropdownInformation');

   
    toggleButton.addEventListener('click', () => {
        drawer.classList.toggle('-translate-x-full');

        
        toggleButton.classList.toggle('hidden', !drawer.classList.contains('-translate-x-full'));
    });

 
    closeButton.addEventListener('click', () => {
        drawer.classList.add('-translate-x-full');
        toggleButton.classList.remove('hidden'); 
    });

    if (dropdownButton && dropdownMenu) {

        const toggleDropdown = () => {
            dropdownMenu.classList.toggle('hidden'); 
            dropdownButton.setAttribute('aria-expanded', !dropdownMenu.classList.contains('hidden')); // อัปเดต aria-expanded
        };

        
        dropdownButton.addEventListener('click', (event) => {
            event.stopPropagation();
            toggleDropdown();
        });

    
        window.addEventListener('click', (e) => {
            if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden'); 
                dropdownButton.setAttribute('aria-expanded', 'false'); 
            }
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const dropdownButton = document.getElementById('dropdownInformationButton');
    const dropdownMenu = document.getElementById('dropdownInformation');

    // Toggle dropdown menu visibility on button click
    dropdownButton.addEventListener('click', function () {
        dropdownMenu.classList.toggle('hidden');
    });

    // Close the dropdown menu if the user clicks outside of it
    window.addEventListener('click', function (event) {
        if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
});
