fetch('http://localhost:8000/backend/categories.php')

.then(Response=>Response.json())    
.then(categories => {
    let ul= document.getElementById("list_category")
    categories.forEach(category => {
        let li=document.createElement("li")
        li.textContent=category.nom;
        ul.appendChild(li);
        
    });
    
})
.catch(erreur => console.error("Erreur de communication :", erreur));