const API_url="http://localhost:8000/backend/api/controller/CategorieController.php";
const form=document.getElementById("form-thematique")
const btnSubmit=document.getElementById("btnSubmit");
const tableBody=document.getElementById("table-thematiques-body");
const colorInput=document.getElementById("couleur");
const colorValue=document.getElementById("couleur-value");
let isloading=false;

colorInput.addEventListener("input",()=>{
    colorValue.textContent=colorInput.value.toUpperCase();
});

function setLoadingState(isloading){
    btnSubmit.disabled=isloading;
    if(isloading){
        btnSubmit.textContent="Enregistrement..."

    }
    else{
         btnSubmit.textContent="Enregistrer"
    }

}

function displayCategories(categories){
    tableBody.replaceChildren();

    categories.forEach(categorie=>{
        const row=document.createElement("tr");
        [categorie.id, categorie.nom, categorie.couleur, categorie.icone].forEach(value=>{
            const cell=document.createElement("td");
            cell.className="px-6 py-3";
            cell.textContent=value ?? "";
            row.appendChild(cell);
        });
        tableBody.appendChild(row);
    });
}

function loadCategories(){
    return fetch(API_url)
        .then(response=>{
            if(!response.ok){
                throw new Error("Impossible de charger les catégories.");
            }
            return response.json();
        })
        .then(categories=>displayCategories(categories));
}

form.addEventListener("submit",e=>{
    e.preventDefault();
    setLoadingState(true);

    fetch(API_url,{
        method: "POST",
        body: new FormData(form)
    })
    .then(response=>response.json().then(data=>({response, data})))
    .then(({response, data})=>{
        if(!response.ok || !data.success){
            throw new Error(data.message || "Erreur lors de l'enregistrement.");
        }

        form.reset();
        showToast(data.message, "succes");
        loadCategories().catch(error=>{
            showToast(error.message, "error");
            console.error(error);
        });
    })
    .catch(error=>{
        showToast(error.message || "Erreur lors de l'enregistrement", "error");
        console.error(error);
    })
    .finally(()=>{
        setLoadingState(false);
    })
});

function showToast(message,type="succes"){

    const container=document.getElementById("toast-container");
    const toastDiv=document.createElement("div");

    toastDiv.className="text-white px-4 py-3 rounded shadow"
    if(type=="succes"){
        toastDiv.className+=" bg-green-500"
    }else{
        toastDiv.className+=" bg-red-500"
    }
    toastDiv.textContent=message;
    
    container.appendChild(toastDiv);
    setTimeout(() => {
        toastDiv.classList.add("opacity-0");
        setTimeout(() => toastDiv.remove(), 300);
    }, 3000);
}

loadCategories().catch(error=>{
    showToast(error.message, "error");
    console.error(error);
});
