import { fetchPage } from './index.js'

function processLoginData(event){
    event.preventDefault()
    let sideNav = document.getElementById("side-nav")
    let email = document.querySelector("#email").value
    let password = document.querySelector("#password").value

    let user = {
        email: email,
        password: password,
        status: "login"
    }
    fetch('http://localhost/info2180-project2/php/index.php', {
        method: "POST",
        body: JSON.stringify(user),
        withCredentials: true
    })
    .then(response => {
        if(response.ok){
            console.log(response)
            return response.json();
        }
        else{
            throw new Error(`An error has occured: ${response.status}`);
        }
    })
    .then(data => {
        if(data["message"] === "User was succesfully logged in"){
            fetchPage("home")
            sideNav.style.visibility = "visible"
        }
    })
    .catch(err => {
        console.log(err);
    })
}

function processUserData(event){
    event.preventDefault()
    let formElements = document.getElementById("add-user-form").elements;

    console.log(formElements)
    let user = {}

    user.status = "add-user"

    for (let i = 0; i < formElements.length; i++) {
        if (formElements[i].nodeName === "INPUT") {
            user[formElements[i].id] = formElements[i].value;
        }
    }

    
    fetch('http://localhost/info2180-project2/php/index.php', {
        method: "POST",
        body: JSON.stringify(user),
    })
    .then(response => {
        if(response.ok){
            return response.json();
        }
        else{
            throw new Error(`An error has occured: ${response.status}`);
        }
    })
    .then(res => {
        alert(res['message'])
    })
    .catch(err => {
        console.log(err);
    })

}
function processIssueData(event){
    event.preventDefault()
    let formElements = document.getElementById("create-issue-form").elements;

    console.log(formElements)
    let issue = {}
    issue.status = "new-issue"

    for (let i = 0; i < formElements.length; i++) {
        if (["INPUT", "SELECT", "TEXTAREA"].includes(formElements[i].nodeName)) {
            issue[formElements[i].id] = formElements[i].value;
        }
    }
    
    fetch('http://localhost/info2180-project2/php/index.php', {
        method: "POST",
        body: JSON.stringify(issue),
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
        alert(data["message"])
    })
    .catch(err => {
        console.log(err);
    })


}



export { processIssueData, processUserData, processLoginData };