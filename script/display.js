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

function displayIssue(id) {

    return `
    <div class="grid-container"> 

        <div class = box1>
            <h1 id="xss" >XSS Vulnerabilty in Add User Form</h1>
            <p id="edt">Issue #100</p>
        </div>
        <div class = "box2">
            
            <p>Energy consumption and generation are two pivotal challenges that have continually confronted Caribbean nations. The effects of these 
            challenges are evident in the increasing cost for oil as well as domestic electricity rates in Caribbean countries. It is for these reasons 
            and more why there is an overwhelming necessity for the transition away from fossil fuels and towards the realm of sustainable energy.
            However, there are a few issues that hinder the transition towards renewables in many CARICOM member states.
            One of the issues CARICOM member states face that hinder their transition to renewables is the uncertainty in the 
            energy prices, as such projections are coherent regarding the oil and gas industry prices. As most of the costs for renewable energy are from 
            the upfront expenses of building and installing solar and wind farms; questions about if the investment was worth it would have been raised. 
            In 2017 the average cost to install solar systems was $2000 per kilowatt compared to $1000 per kilowatt for a new natural gas plant. This 
            higher construction cost would make financial institutions perceive renewable energy as a risky investment compared to the coherent and stable 
            cost of gas and oil with a lower construction cost for a power plant. One way of combating the issue of high installation prices for renewables 
            is by using a method known as energy auctions. This is where countries ask for competitive bids for large-scale energy contracts (power plants).
            The country then chooses the energy project developer with a contract that offers the lowest possible price.<br><br></p>

            <div>
                <p>> Issue created on November 1, 2019 at 4:30pm by Marsha Brady</p>
            </div>
            <div>
                <p>> Last updated on November 8, 2019 at 10:00am</p>
            </div>
        </div>
        <div class = "box3">
            <section>
                <div>
                    <h3>Assigned To</h3>
                    <p>Tom Brady</p>
                </div>
                <div>
                    <h3>Type:</h3>
                    <p>Proposal</p>
                </div>
                <div>
                    <h3>Priority:</h3>
                    <p>Major</p>
                </div>
                <div>
                    <h3>Status:</h3>
                    <p>Open</p>
                </div>
        
                <div class="box4">
                    <div>
                        <button type="close" class="btn_close">Mark as Close</button>
                    </div>
                    <div>
                        <button type="progress" class="btn_open">Mark In Progress</button>
                    </div>
                </div> 
            </section>
        </div>   

    </div>`
}


export { displayIssueForm, displayHomePage, displayAddUserPage, displayIssue }