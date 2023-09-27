function toggleContent() {
    var contentDiv = document.getElementById("content");

    if (contentDiv.style.display === "none") {
        contentDiv.style.display = "block";
    } else {
        contentDiv.style.display = "none";
    }
}
document.addEventListener("DOMContentLoaded", function() {
    var contentDiv = document.getElementById("content");
    contentDiv.style.display = "none";
});