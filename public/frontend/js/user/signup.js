const signForm = document.querySelector(".signup.form form"),
    signContinueBtn = signForm.querySelector(".signup .button input[type='submit']"),
    signErrorText = signForm.querySelector(".signup .error-text");
const signPassField = document.querySelector(".signup.form input[type='password']"),
    toggleIcon = document.querySelector(".signup.form .field i");

toggleIcon.addEventListener('click', function () {
    if (signPassField.type === "password") {
        signPassField.type = "text";
        toggleIcon.classList.add("active");
    } else {
        signPassField.type = "password";
        toggleIcon.classList.remove("active");
    }
})

signForm.addEventListener('submit', function (e) {
    e.preventDefault();
})


signContinueBtn.addEventListener('click', function () {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "user/actionSignup", true);
    xhr.addEventListener('load', function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (data === "success") {
                    location.href = "chat";
                } else {
                    signErrorText.style.display = "block";
                    signErrorText.textContent = data;
                }
            }
        }
    })
    let formData = new FormData(signForm);
    xhr.send(formData);
})