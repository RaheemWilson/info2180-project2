//Main module that loads event when a particular page is displayed
import { processIssueData, processLoginData, processUserData } from './post.js'
import { displayIssueForm, displayHomePage, displayAddUserPage, displayIssue, displayLogin } from './display.js'
import { getIssues, getIssuesOpen, getIssuesUser, updateIssue } from './query.js'

window.onload = loadEvents()

function loadEvents(){ 
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
                case "logout":
                    logoutUser()
                    break;
                default:
                    break;
            }   
        })
        
    })
    sideNav.style.visibility = "hidden"
    addEvents()
}

async function fetchPage(page, id) { 
    let container = document.querySelector(".container");
    
    if(page === "home"){
        container.innerHTML = displayHomePage()
        addHomeEvents("all")
        let btns = document.querySelectorAll(".btns button")
    
        btns.forEach(btn => {
            btn.addEventListener('click', function(event){

                document.querySelectorAll(".btns button").forEach(btn => {
                    btn.classList.remove("active")
                })

                btn.classList.add("active")
                addHomeEvents(event.target.id)
            })
        })
        
    } else if(page === "add-user"){
        container.innerHTML = displayAddUserPage()
    } else if(page === "new-issue") {
        container.innerHTML = await displayIssueForm()
    } else if(page === "issue"){
        container.innerHTML = await displayIssue(id)
        addIssueEvents(id)
    } else {
        container.innerHTML = displayLogin()
        loadEvents()
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
                form.addEventListener('submit', processLoginData)
                break;
            case "add-user-form":
                form.addEventListener('submit', processUserData)
                break;
            case "create-issue-form":
                form.addEventListener('submit', processIssueData)
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

function handleIssue(event) {
    fetchPage('issue', event.target.id)
}

async function addHomeEvents(id){
    var issues = null
    switch (id) {
        case "all":

            issues = await getIssues()
            break;
        case "open":
            issues = await getIssuesOpen()
            break;
        case "user":
            issues = await getIssuesUser()
            break;
    
        default:
            break;
    }

    let tableData = ""
    issues.forEach(issue =>{
        tableData += `
        <tr>
            <td>#${issue.id} <button class="issue-btn" id=${issue.id}>${issue.title}</button></td> 
            <td>${issue.type}</td> 
            <td class="status ${issue.status === "IN PROGRESS" ? "IN-PROGRESS" : issue.status}">
            <h3>${issue.status}</h3>
            </td>
            <td>${issue.firstname} ${issue.lastname}</td>
            <td>${issue.created.split(" ")[0]}</td>
        </tr> `
    })
    let tableBody = document.getElementById('table-body')
    tableBody.innerHTML = tableData

    let buttons = document.querySelectorAll("td button")

    buttons.forEach(button => {
        button.addEventListener('click', handleIssue)
    })
}


async function addIssueEvents(id){
    let btns = document.querySelectorAll(".box3 button")

    btns.forEach(btn => {
        btn.onclick = function(){
            if(btn.id == "btn_close"){
                updateIssue("CLOSED", id)
            } else {
                updateIssue("IN PROGRESS", id)
            }
            fetchPage("issue", id)
        }
        
    })
}


async function logoutUser() {
    let res = await fetch(`http://localhost/info2180-project2/php/index.php?user=logout`,
    {
        method: "GET",
    })
    let status = await res.status
    if(status === 200){
        fetchPage("login")
    }
}

export { fetchPage, addEvents, handleIssue };



