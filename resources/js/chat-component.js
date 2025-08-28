document.addEventListener("DOMContentLoaded", () => {
    const chatBtn = document.getElementById("chat-button");
    const chatContainer = document.getElementById("chat-container");
    const closeBtnChat = document.getElementById("close-button");
    const inputMessageBtn = document.getElementById("input-message");
    const sendMessageBtn = document.getElementById("send-message");

    chatBtn.addEventListener("click", () => {
        chatContainer.classList.toggle("visible");
    });

    closeBtnChat.addEventListener("click", (e) => {
        e.preventDefault();
        chatContainer.classList.remove("visible");
    });

    inputMessageBtn.addEventListener("keydown", (e) => {
        if (e.key === "Enter") {
            e.preventDefault();
            sendMessageBtn.click();
        }
    });
});
