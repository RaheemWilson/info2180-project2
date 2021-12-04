//This module handles all the GET and PATCH request to server
async function getIssues() {
    let res = await fetch(`http://localhost/info2180-project2/php/index.php?issues=all`,
    {
        method: "GET",
    })
    let issues = await res.json()
    return issues;
}

async function getIssue(id) {
    let res = await fetch(`http://localhost/info2180-project2/php/index.php?issue=${id}`,
    {
        method: "GET",
    })
    let issue = await res.json()
    return issue;
}

async function getIssuesOpen() {
    let res = await fetch(`http://localhost/info2180-project2/php/index.php?issues=open`,
    {
        method: "GET",
    })
    let issue = await res.json()
    return issue;
}

async function getIssuesUser() {
    let res = await fetch(`http://localhost/info2180-project2/php/index.php?issues=user`,
    {
        method: "GET",
    })
    let issue = await res.json()
    return issue;
}

async function updateIssue(statusChange, id) {
    console.log(statusChange)
    let res = await fetch(`http://localhost/info2180-project2/php/index.php?issue=${id}`,
    {
        method: "PATCH",
        body: JSON.stringify({ status : statusChange, _id : id })
    })
    let issue = await res.json()
    return issue;
}


export { getIssues, getIssue, getIssuesOpen, getIssuesUser, updateIssue }