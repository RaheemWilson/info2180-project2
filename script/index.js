import { processIssueData, processLoginData, processUserData } from './post.js'

window.onload = function(){ 
    let sideNav = document.getElementById("side-nav")
    let buttons = document.querySelectorAll('#side-nav li')
        buttons.forEach(button => {
            console.log("run")
            switch (button.id) {
                // case "home":
                //     break;
                case "add-user":
                    button.addEventListener('click', () =>{
                        fetchForm('add-user')
                    })   
                    break;
                case "new-issue":
                    button.addEventListener('click', () =>{
                        fetchForm('new-issue')
                    })
                    break;
                // case "home":
                    
                //     break;
            
                default:
                    break;
            }
    })
    sideNav.style.visibility = "hidden"
    fetchForm("login")
}

function fetchForm(section) { 
    let container = document.querySelector(".container");
    fetch(`http://localhost/info2180-project2/php/index.php?section=${section}`)
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
}

export { fetchForm, addEvents };



