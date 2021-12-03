import { processIssueData, processLoginData, processUserData } from './post.js'
import { displayIssueForm, displayHomePage, displayAddUserPage } from './display.js'

window.onload = function(){ 
    let sideNav = document.getElementById("side-nav")
    let buttons = document.querySelectorAll('#side-nav li')
    buttons.forEach(button => {
        button.addEventListener('click', () =>{
            switch (button.id) {
                case "home":
                    fetchPage("home")
                    break;
                case "add-user":
                        fetchPage("add-user")
                    break;
                case "new-issue":
                        fetchPage("new-issue")
                    break;
                default:
                    break;
            }   
        })
        
    })
    sideNav.style.visibility = "hidden"
    addEvents()
}

async function fetchPage(page) { 
    let container = document.querySelector(".container");
    
    if(page === "home"){
        displayHomePage()
        .then(res => {
            container.innerHTML = res
        })
    } else if(page === "add-user"){
        container.innerHTML = displayAddUserPage()
    } else {
        container.innerHTML = await displayIssueForm()
    }

    addEvents()

}


function addEvents(){
    let submitBtn = document.querySelector(".submit-btn")
    let form = document.getElementsByTagName("form")[0]
    let container = document.querySelector(".container");

    if(form){
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

    if(container){
        let issueBtn = document.getElementById("create-issue-btn")
        if(issueBtn){
            issueBtn.onclick = function(){
                displayIssueForm()
                .then(res => {
                    container.innerHTML = res
                })
            }
        }
    }
    
}

export { fetchPage, addEvents };



