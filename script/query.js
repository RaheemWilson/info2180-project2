function getIssues() {
    let res = await fetch(`http://localhost/info2180-project2/php/index.php?issue=all`,
    {
        method: "GET",
    })
    let users = await res.json()
        console.log(users)
}