//This module handles all the pages that being displayed
import {getIssue} from './query.js'

async function displayIssueForm() {
    let res = await fetch(`http://localhost/info2180-project2/php/index.php?user=all`,
        {
            method: "GET",
        })
    let users = await res.json()
        console.log(users)
    let optionStr = ""
    users.forEach(user => {
        optionStr += `<option value=${user.id}>${user.firstname} ${user.lastname}</option>`
    });

    return `
        <div> 
        <h1>Create Issue</h1>
        <form id="create-issue-form" method="post">
            <div>
                <label for="title">Title</label>
                <input type="text" name="title" id="title" required/>
            </div>
            <div>
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="30" rows="10" required></textarea>
            </div>
            <div>
                <label for="assigned">Assigned To</label>
                <select name="assigned" id="assigned" required>
                    ${optionStr}
                </select>
            </div>
            <div>
                <label for="type">Type</label>
                <select name="type" id="type" required>
                    <option value="Bug">Bug</option>
                    <option value="Proposal">Proposal</option>
                    <option value="Task">Task</option>
                </select>
            </div>
            <div>
                <label for="priority">Priority</label>
                <select name="priority" id="priority" required>
                    <option value="Minor">Minor</option>
                    <option value="Major">Major</option>
                    <option value="Critical">Critical</option>
                </select>
            </div>
            <button type="submit" class="submit-btn">Submit</button>
        </form>
        </div>
    `
}

function displayHomePage(){
    return `
    <div>
        <div class="issue-header">
            <h1>Issues</h1>
            <button id="create-issue-btn">Create New Issue</button>
        </div>
        <div class="filters">
            <span>Filter By:</span>
            <div class="btns">
                <button id="all" class="filter-btn active">ALL</button>
                <button id="open" class="filter-btn">OPEN</button>
                <button id="user" class="filter-btn">MY TICKETS</button>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Type</th>
                    <th scope="col" class="status">Status</th>
                    <th scope="col">Assigned To</th>
                    <th scope="col">Created</th>
                </tr>
            </thead>
            <tbody id="table-body">
                
            </tbody>
        </table>
            
    </div>

    `
}

function displayAddUserPage() {
    return `
        <div> 
        <h1>New User</h1>
        <form id="add-user-form" method="post">
            <div>
                <label for="firstname">Firstname</label>
                <input type="text" name="firstname" id="firstname" required="required"/>
            </div>
            <div>
                <label for="lastname">Lastname</label>
                <input type="text" name="lastname" id="lastname" required="required"/>
            </div>
            <div>
                <label for="password">Password</label>
                <input 
                    type="password" 
                    name="password" id="password" 
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                    required="required"
                    title="Password must have at least one number and one letter, and one captial letter, and at least 8 or more characters"
                />
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required="required"/>
            </div>
            <button type="submit" class="submit-btn">Submit</button>
        </form>
        </div>
    `
}

async function displayIssue(id) {
    let currentIssue = await getIssue(id)

    if(currentIssue){
        var options = {year: 'numeric', month: 'long', day: 'numeric' };
        let dateCreated = new Date(currentIssue.created)
        var createdDate = dateCreated.toLocaleDateString('en-US', options)
        var createdTime = dateCreated.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' })

        var dateUpdated = new Date(currentIssue.updated)
        var updatedDate = dateUpdated.toLocaleDateString('en-US', options)
        var updatedTime = dateUpdated.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' })
        
    }
    return `
    <div class="grid-container"> 

        <div class = box1>
            <h1 id="xss" >${currentIssue.title}</h1>
            <h4 id="edt">Issue #${currentIssue.id}</h4>
        </div>
        <div class = "box2">
            
            <p>
            ${currentIssue.description}
            <br><br>
            </p>

            <div>
                <p>> Issue created on ${createdDate} at ${createdTime} by ${currentIssue.created_by.firstname} ${currentIssue.created_by.lastname}</p>
            </div>
            <div>
                <p>> Last updated on ${updatedDate} at ${updatedTime}</p>
            </div>
        </div>
        <div class = "box3">
            <div class="info">
                <div>
                    <h3>Assigned To</h3>
                    <p>${currentIssue.assigned_to.firstname} ${currentIssue.assigned_to.lastname}</p>
                </div>
                <div>
                    <h3>Type:</h3>
                    <p>${currentIssue.type}</p>
                </div>
                <div>
                    <h3>Priority:</h3>
                    <p>${currentIssue.priority}</p>
                </div>
                <div>
                    <h3>Status:</h3>
                    <p>${currentIssue.status}</p>
                </div>
            </div>
            <div>
                <button id="btn_close">Mark as Close</button>
            </div>
            <div>
                <button id="btn_progress">Mark In Progress</button>
            </div>
        </div>   

    </div>`
}

function displayLogin(){
    return `
    <div class="login">
        <div> 
            <h1>Welcome!</h1>
            <p id="form-desc">Please enter your login details to gain access to the BugMe Issue Tracker System.</p>
            <form id="login-form" method="post">
                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required/>
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required/>
                </div>
                <button type="submit" class="submit-btn">Login</button>
            </form>
            <div id="error"></div>
        </div>
    </div>
    `
}

export { displayIssueForm, displayHomePage, displayAddUserPage, displayIssue, displayLogin }