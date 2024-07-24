// Function to check member
function cekMember() {
    var nama = document.getElementById("qrcode").value;
    var loadingAnimation = document.getElementById("loading-animation");

    var xhr = new XMLHttpRequest();

    // Show loading animation
    loadingAnimation.style.display = "inline-block";
    document.getElementById("hasil-cek").classList.remove("show");
    document.getElementById("hasil-cek").innerHTML = "";

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            loadingAnimation.style.display = "none";

            if (xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);
                document.getElementById("hasil-cek").innerHTML =
                    response.message;
                document.getElementById("hasil-cek").classList.add("show"); // Show new results
            }
        }
    };
    xhr.open("GET", `/admin/cekMember/${encodeURIComponent(nama)}`, true);
    xhr.send();
}

// Ensure document is ready before adding event listener
document.addEventListener("DOMContentLoaded", function () {
    document
        .querySelector('button[onclick="cekMember()"]')
        .addEventListener("click", cekMember);
});
