import { processIssueData, processLoginData, processUserData } from './post.js'
import { displayIssueForm, displayHomePage, displayAddUserPage, displayIssue } from './display.js'
import {getIssues} from './query.js'

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

async function fetchPage(page, id) { 
    let container = document.querySelector(".container");
    
    if(page === "home"){
        container.innerHTML = displayHomePage()
        let issues = await getIssues()
        console.log(typeof issues)
        let tableData = ""
        issues.forEach(issue =>{
            tableData += `
            <tr>
                <td>#${issue.id} <button class="issue" id=${issue.id}>${issue.title}</button></td> 
                <td>${issue.type}</td> 
                <td class="status ${issue.status === "IN PROGRESS" ? "IN-PROGRESS" : issue.status}">
                <h3>${issue.status}</h3>
                </td>
                <td>${issue.assigned_to}</td>
                <td>${issue.created.split(" ")[0]}</td>
            </tr> `
        })
        let tableBody = document.getElementById('table-body')
        tableBody.innerHTML = tableData

        let buttons = document.querySelectorAll("td button")

        buttons.forEach(button => {
            button.addEventListener('click', handleIssue)
        })
        
    } else if(page === "add-user"){
        container.innerHTML = displayAddUserPage()
    } else if(page === "new-issue") {
        container.innerHTML = await displayIssueForm()
    } else {
        container.innerHTML = displayIssue(id)
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

function handleIssue(event) {
    fetchPage('issue', event.target.id)
}

export { fetchPage, addEvents, handleIssue };



