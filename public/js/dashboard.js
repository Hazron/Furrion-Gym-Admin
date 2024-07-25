function cekMember() {
    var nama = document.getElementById("qrcode").value;
    var loadingAnimation = document.getElementById("loading-animation");

    var xhr = new XMLHttpRequest();

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
                document.getElementById("hasil-cek").classList.add("show");
            }
        }
    };
    xhr.open("GET", `/admin/cekMember/${encodeURIComponent(nama)}`, true);
    xhr.send();
}

function cekPT() {
    var nama = document.getElementById("personalTrainer").value;
    var loadingAnimation = document.getElementById("loading-animation");

    var xhr = new XMLHttpRequest();

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
                document.getElementById("hasil-cek").classList.add("show");
            }
        }
    };
    xhr.open("GET", `/admin/cekPT/${encodeURIComponent(nama)}`, true);
    xhr.send();
}
