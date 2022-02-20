const chatForm = document.querySelector(".chat-area .typing-area"),
    chatBox = document.querySelector(".chat-area .chat-box");
if (chatBox != null) {
    const chatIncoming_id = chatForm.querySelector(".incoming_id").value,
        chatInputField = chatForm.querySelector(".input-field"),
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
}


