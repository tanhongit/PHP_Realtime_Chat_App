//login
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

    logForm.addEventListener('submit', function (e) {
        e.preventDefault();
    })

    logContinueBtn.addEventListener('click', function () {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "/user/actionLogin", true);
        xhr.addEventListener('load', function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    if (data === "success") {
                        location.href = "/chat";
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

//signin
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
        xhr.open("POST", "/user/actionSignup", true);
        xhr.addEventListener('load', function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    if (data === "success") {
                        location.href = "/chat";
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

//load user list
const userSearchBar = document.querySelector(".users .search input");
if (userSearchBar != null) {
    const userSearchIcon = document.querySelector(".users .search button"),
        usersList = document.querySelector(".users .users-list");

    setInterval(() => {
        let xhr = new XMLHttpRequest();
        xhr.open("GET", "/user/actionGetList", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    if (!userSearchBar.classList.contains("active")) {
                        usersList.innerHTML = data;
                    }
                }
            }
        }
        xhr.send();
    }, 1500);

    //search user list
    userSearchIcon.onclick = () => {
        userSearchBar.classList.toggle("show");
        userSearchIcon.classList.toggle("active");
        userSearchBar.focus();
        if (userSearchBar.classList.contains("active")) {
            userSearchBar.value = "";
            userSearchBar.classList.remove("active");
        }
    }

    userSearchBar.addEventListener('keyup', function () {
        let searchTerm = userSearchBar.value;
        if (searchTerm != "") {
            userSearchBar.classList.add("active");
        } else {
            userSearchBar.classList.remove("active");
        }
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "/user/actionSearch", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    usersList.innerHTML = data;
                }
            }
        }
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("keyword=" + searchTerm);
    })
}
