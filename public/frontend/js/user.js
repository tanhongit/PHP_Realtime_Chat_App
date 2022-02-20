const logForm = document.querySelector(".login.form form");

if (logForm != null) {
    const logContinueBtn = document.querySelector(".login .button input[type='submit']"),
        logErrorText = document.querySelector(".login .error-text");
    const logPassField = document.querySelector(".login.form input[type='password']"),
        logToggleIcon = document.querySelector(".login.form .field i");

    logToggleIcon.addEventListener('click', function () {
        if (logPassField.type === "password") {
            logPassField.type = "text";
            logToggleIcon.classList.add("active");
        } else {
            logPassField.type = "password";
            logToggleIcon.classList.remove("active");
        }
    })

    logContinueBtn.addEventListener('submit', function (e) {
        e.preventDefault();
    })

    logContinueBtn.addEventListener('click', function () {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "user/actionLogin", true);
        xhr.addEventListener('load', function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    if (data === "success") {
                        location.href = "chat";
                    } else {
                        logErrorText.style.display = "block";
                        logErrorText.textContent = data;
                    }
                }
            }
        })
        let formData = new FormData(logForm);
        xhr.send(formData);
    })
}

const signForm = document.querySelector(".signup.form form");

if (signForm != null) {
    const signContinueBtn = signForm.querySelector(".signup .button input[type='submit']"),
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
}