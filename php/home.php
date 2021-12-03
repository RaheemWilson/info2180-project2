

<div>
    <div class="issue-header">
        <h1>Issues</h1>
        <button class="create-issue-btn">Create New Issue</button>
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
        <tbody>
            <?php foreach ($issue_table as $issue_row): ?>
            <tr>
                <td><?= $issue_row['title']; ?></td> 
                <td><?= $issue_row['type']; ?></td> 
                <td class="status <?= $issue_row['status'] === "IN PROGRESS" ? "IN-PROGRESS" : $issue_row['status']?>">
                <h3><?= $issue_row['status']; ?></h3>
                </td>
                <td><?= $issue_row['assigned_to']; ?></td>
                <td><?= $issue_row['created']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
        
</div>


