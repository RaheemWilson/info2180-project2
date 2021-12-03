import { getIssues } from './query.js'


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
                <input type="text" name="title" id="title"/>
            </div>
            <div>
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="30" rows="10"></textarea>
            </div>
            <div>
                <label for="assigned">Assigned To</label>
                <select name="assigned" id="assigned">
                    ${optionStr}
                </select>
            </div>
            <div>
                <label for="type">Type</label>
                <select name="type" id="type">
                    <option value="bug">Bug</option>
                    <option value="proposal">Proposal</option>
                    <option value="task">Task</option>
                </select>
            </div>
            <div>
                <label for="priority">Priority</label>
                <select name="priority" id="priority">
                    <option value="minor">Minor</option>
                    <option value="major">Major</option>
                    <option value="critical">Critical</option>
                </select>
            </div>
            <button type="submit" class="submit-btn">Submit</button>
        </form>
        </div>
    `
}

async function displayHomePage(){
    let res = await fetch(`http://localhost/info2180-project2/php/index.php?issue=all`,
    {
        method: "GET",
    })
    let issues = await res.json()
    console.log(issues)
    return `
    <div>
        <div class="issue-header">
            <h1>Issues</h1>
            <button id="create-issue-btn">Create New Issue</button>
        </div>
        <div class="filters">
            <span>Filter By:</span>
            <div class="btns">
                <button class="filter-btn active">ALL</button>
                <button class="filter-btn">OPEN</button>
                <button class="filter-btn">MY TICKETS</button>
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
            <tbody class="table-body">
                <tr>
                    <td>Issue</td> 
                    <td>Bad</td> 
                    <td class="status OPEM">
                    <h3>OPEM ?></h3>
                    </td>
                    <td>Somebody</td>
                    <td>Yes</td>
                </tr>
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
                <input type="text" name="firstname" id="firstname"/>
            </div>
            <div>
                <label for="lastname">Lastname</label>
                <input type="text" name="lastname" id="lastname"/>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"/>
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email"/>
            </div>
            <button type="submit" class="submit-btn">Submit</button>
        </form>
        </div>
    `
}


export { displayIssueForm, displayHomePage, displayAddUserPage }