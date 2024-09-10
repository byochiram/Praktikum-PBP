// Generate Captcha
let generatedCaptcha = '';

function generateCaptcha() {
    const captchaLength = 5;
    generatedCaptcha = '';

    for (let i = 0; i < captchaLength; i++) {
        // Generate a random uppercase letter (A-Z)
        const charCode = Math.floor(Math.random() * 26) + 65; // Uppercase letters A-Z
        generatedCaptcha += String.fromCharCode(charCode);
    }

    document.getElementById('captchaText').innerText = generatedCaptcha;
}

// Update Subcategory based on Category selection
document.getElementById('category').addEventListener('change', function() {
    const category = this.value;
    const subcategory = document.getElementById('subcategory');
    subcategory.innerHTML = '';

    let options = '';

    if (category === 'Baju') {
        options = '<option value="Baju Pria">Baju Pria</option>' +
                  '<option value="Baju Wanita">Baju Wanita</option>' +
                  '<option value="Baju Anak">Baju Anak</option>';
    } else if (category === 'Elektronik') {
        options = '<option value="Mesin Cuci">Mesin Cuci</option>' +
                  '<option value="Kulkas">Kulkas</option>' +
                  '<option value="AC">AC</option>';
    } else if (category === 'Alat Tulis') {
        options = '<option value="Kertas">Kertas</option>' +
                  '<option value="Map">Map</option>' +
                  '<option value="Pulpen">Pulpen</option>';
    }

    subcategory.innerHTML = options;
});

// Enable/Disable Wholesale Price based on Grosir selection
document.querySelectorAll('input[name="grosir"]').forEach((elem) => {
    elem.addEventListener('change', function() {
        const wholesalePrice = document.getElementById('wholesalePrice');
        if (this.value === 'yes') {
            wholesalePrice.disabled = false;
            wholesalePrice.setAttribute('required', true);
        } else {
            wholesalePrice.disabled = true;
            wholesalePrice.removeAttribute('required');
        }
    });
});

// Validate Minimum 3 Shipping Services Selected and Captcha
document.getElementById('productForm').addEventListener('submit', function(event) {
    const checkboxes = document.querySelectorAll('input[name="shipping"]:checked');
    const enteredCaptcha = document.getElementById('captcha').value;

    if (checkboxes.length < 3) {
        alert('Pilih minimal 3 jasa kirim.');
        event.preventDefault();
    } else if (enteredCaptcha !== generatedCaptcha) {
        alert('Captcha tidak sesuai. Silakan coba lagi.');
        event.preventDefault();
        generateCaptcha(); // Generate new Captcha after failed attempt
    }
});

// Generate Captcha on page load
generateCaptcha();
