window.onload = function(){ 
    fetchForm("form", "login")
}

function fetchForm(url, section) { 
    let container = document.querySelector(".container");
    fetch(`http://localhost/info2180-project2/php/${url}.php?section=${section}`)
    .then(response => {
        if(response.ok){
            return response.text();
        }
        else{
            throw new Error(`An error has occured: ${response.status}`);
        }
    })
    .then(data => {
        container.innerHTML = data;
        addEvents()
    })
    .catch(err => {
        console.log(err);
    })
}

function addEvents(){
    let submitBtn = document.querySelector(".submit-btn")
    console.log(submitBtn)
    submitBtn.addEventListener('click', processFormData)
}

function processFormData(event){
    event.preventDefault()
    let email = document.querySelector("#email").value
    let password = document.querySelector("#password").value
    let container = document.querySelector(".container");

    let loginForm = new FormData()
    loginForm.set('status', 'login')
    loginForm.set("email", email)
    loginForm.set("password", password)

    fetch('http://localhost/info2180-project2/php/process-form.php', {
        method: "POST",
        body: loginForm
    })
    .then(response => {
        if(response.ok){
            return response.json();
        }
        else{
            throw new Error(`An error has occured: ${response.status}`);
        }
    })
    .then(data => {
        console.log(data)
        fetchForm("dashboard", "new_user")
    })
    .catch(err => {
        console.log(err);
    })


}