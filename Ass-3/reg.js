document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("registrationForm");

    const nameInput = document.getElementById("name");
    const emailInput = document.getElementById("email");
    const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("confirmPassword");
    const phoneInput = document.getElementById("phone");
    const dobInput = document.getElementById("dob");
    const ageInput = document.getElementById("age");
    const genderInputs = document.getElementsByName("gender");

    // Event Listeners for Real-Time Validation
    nameInput.addEventListener("input", validateName);
    emailInput.addEventListener("input", validateEmail);
    passwordInput.addEventListener("input", validatePassword);
    confirmPasswordInput.addEventListener("input", validateConfirmPassword);
    phoneInput.addEventListener("input", validatePhone);
    dobInput.addEventListener("input", validateDOB);
    ageInput.addEventListener("input", validateAge);
    
    form.addEventListener("submit", function (event) {
        event.preventDefault();

        if (
            validateName() &&
            validateEmail() &&
            validatePassword() &&
            validateConfirmPassword() &&
            validatePhone() &&
            validateDOB() &&
            validateGender() &&
            validateAge()
        ) {
            alert("Registration Successful!");
            form.reset();
        }
    });

    // Validation Functions
    function validateName() {
        if (nameInput.value.trim().length < 3) {
            showError(nameInput, "Name must be at least 3 characters.");
            return false;
        } else {
            hideError(nameInput);
            return true;
        }
    }

    function validateEmail() {
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailPattern.test(emailInput.value.trim())) {
            showError(emailInput, "Enter a valid email.");
            return false;
        } else {
            hideError(emailInput);
            return true;
        }
    }

    function validatePassword() {
        if (passwordInput.value.length < 6) {
            showError(passwordInput, "Password must be at least 6 characters.");
            return false;
        } else {
            hideError(passwordInput);
            return true;
        }
    }

    function validateConfirmPassword() {
        if (confirmPasswordInput.value !== passwordInput.value) {
            showError(confirmPasswordInput, "Passwords do not match.");
            return false;
        } else {
            hideError(confirmPasswordInput);
            return true;
        }
    }

    function validatePhone() {
        if (!/^\d{10}$/.test(phoneInput.value.trim())) {
            showError(phoneInput, "Enter a valid 10-digit phone number.");
            return false;
        } else {
            hideError(phoneInput);
            return true;
        }
    }

    function validateDOB() {
        if (!dobInput.value) {
            showError(dobInput, "Please select your date of birth.");
            return false;
        } else {
            hideError(dobInput);
            return true;
        }
    }

    function validateGender() {
        if (![...genderInputs].some(input => input.checked)) {
            showError(genderInputs[0], "Please select a gender.");
            return false;
        } else {
            hideError(genderInputs[0]);
            return true;
        }
    }

    function validateAge() {
        if (ageInput.value < 18) {
            showError(ageInput, "You must be at least 18.");
            return false;
        } else {
            hideError(ageInput);
            return true;
        }
    }

    function showError(input, message) {
        input.nextElementSibling.textContent = message;
        input.nextElementSibling.style.display = "block";
    }

    function hideError(input) {
        input.nextElementSibling.textContent = "";
        input.nextElementSibling.style.display = "none";
    }
});
