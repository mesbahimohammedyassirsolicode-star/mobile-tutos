const API_url="http://localhost:8000/backend/api/controller/CategorieController.php";
const form=document.getElementById("form-thematique")
const btnSubmit=document.getElementById("btnSubmit");
let isloading=false;

function setLoadingState(isloading){
    
    if(isloading){
        btnSubmit.textContent="Enregistrement..."

    }
    else{
         btnSubmit.textContent="Enregistrer"
    }

}
form.addEventListener("submit",e=>{
    e.preventDefault();
    setLoadingState(true);

    fetch(API_url,{
        method: "POST",
        body: new FormData(form)
    })
    .then(response=>response.json())
    .then(data=>{
        console.log("succes",data)
        form.reset();
    })
    .catch(error=>{
        console.error("L’erreur Réseau", error)
    })
    .finally(()=>{
        setLoadingState(false);
    })
});