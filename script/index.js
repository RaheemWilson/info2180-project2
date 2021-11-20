
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
    let form = document.getElementsByTagName("form")[0]

    switch (form.id) {
        case "login-form":
            submitBtn.addEventListener('click', processLoginData)
            break;
        case "add-user-form":
            submitBtn.addEventListener('click', processUserData)
            break;
        case "create-issue-form":
            submitBtn.addEventListener('click', processIssueData)
            break;
        default:
            break;
    }  
}

function processLoginData(event){
    event.preventDefault()
    let email = document.querySelector("#email").value
    let password = document.querySelector("#password").value
    let container = document.querySelector(".container");

    let loginForm = new FormData()
    loginForm.set('status', 'login')
    loginForm.set("email", email)
    loginForm.set("password", password)

    fetch('http://localhost/info2180-project2/php/index.php?user=all', {
        method: "POST",
        body: loginForm
    })
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
    })
    .catch(err => {
        console.log(err);
    })

}

