const chatForm = document.querySelector(".chat-area .typing-area"),
    chatBox = document.querySelector(".chat-area .chat-box");
if (chatBox != null) {
    const chatIncomingId = chatForm.querySelector(".incoming_id").value,
        chatInputField = chatForm.querySelector('input[name="message"]'),
        chatSendBtn = chatForm.querySelector(".chat-area button.btn-send");

    chatForm.addEventListener('submit', function (e) {
        e.preventDefault();
    })

    //send button
    chatInputField.addEventListener('keyup', function (e) {
        if (chatInputField.value != "") {
            chatSendBtn.classList.add("active");
        } else {
            chatSendBtn.classList.remove("active");
        }
    })

    chatBox.addEventListener('mouseenter', function (e) {
        chatBox.classList.add("active");
    })
    chatBox.addEventListener('mouseleave', function (e) {
        chatBox.classList.remove("active");
    })

    //insert chat item
    chatSendBtn.addEventListener('click', function (e) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "/chat/actionAddChatItem", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    chatInputField.value = "";
                    scrollToBottom();
                }
            }
        }
        let formData = new FormData(chatForm);
        xhr.send(formData);
    })

    function scrollToBottom() {
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    //get chat item
    setInterval(function () {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "/chat/actionGetChatItem", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    chatBox.innerHTML = data;
                    //check, load bottom when deactivate chat box
                    if (!chatBox.classList.contains("active")) {
                        scrollToBottom();
                    }
                }
            }
        }
        let formData = new FormData(chatForm);
        xhr.send(formData);
    }, 1500);

}


