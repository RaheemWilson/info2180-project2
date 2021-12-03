async function getIssues() {
    let res = await fetch(`http://localhost/info2180-project2/php/index.php?issue=all`,
    {
        method: "GET",
    })
    let issues = await res.json()
    return issues;
}

export { getIssues }