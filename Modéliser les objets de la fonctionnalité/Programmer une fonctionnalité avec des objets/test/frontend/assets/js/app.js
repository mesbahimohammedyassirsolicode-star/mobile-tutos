const API_url = "http://localhost:8000/backend/api/controller/CategorieController.php";
const form = document.getElementById("form-thematique");
const btnSubmit = document.getElementById("btnSubmit");

function setLoadingState(isLoading) {
    btnSubmit.textContent = isLoading ? "Enregistrement..." : "Enregistrer";
}

function showToast(message, type = "success") {
    const container = document.getElementById("toast-container");
    const toast = document.createElement("div");
    toast.className = `toast toast-${type}`;
    toast.textContent = message;

    container.appendChild(toast);
    setTimeout(() => {
        toast.remove();
    }, 3000);
}

form.addEventListener("submit", (event) => {
    event.preventDefault();
    setLoadingState(true);

    fetch(API_url, {
        method: "POST",
        body: new FormData(form)
    })
        .then((response) => response.json())
        .then((data) => {
            console.log("succes", data);
            showToast("categorie save with sucess!", "success");
            form.reset();
        })
        .catch((error) => {
            showToast("error réseau : impossible de contacer la serveur", "error");
            console.error("L’erreur Réseau", error);
        })
        .finally(() => {
            setLoadingState(false);
        });
});
