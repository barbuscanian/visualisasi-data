document.addEventListener("DOMContentLoaded", function() {
    var toggleButton = document.getElementById("toggleButton");
    var contentDiv1 = document.getElementById("content1");

    toggleButton.addEventListener("click", function() {
        if (contentDiv1.classList.contains("content-hidden")) {
            contentDiv1.classList.remove("content-hidden");
            contentDiv1.classList.add("content-visible");
        } else {
            contentDiv1.classList.remove("content-visible");
            contentDiv1.classList.add("content-hidden");
        }
    });
});
