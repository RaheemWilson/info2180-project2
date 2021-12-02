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
    <?php 
        $issue_table = [
            [
                "title" => "Something ",
                "type" => "Steve Rogers",
                "status" => "OPEN",
                "assigned_to" => "Recipient",
                "created" => "date"
            ],
            [
                "title" => "Something",
                "type" => "Steve Rogers",
                "status" => "CLOSED",
                "assigned_to" => "Recipient",
                "created" => "date"
            ],
            [
                "title" => "Something",
                "type" => "Steve Rogers",
                "status" => "IN PROGRESS",
                "assigned_to" => "Recipient",
                "created" => "date"
            ],
        ];
        include 'issues-table.php'; 
    ?>
</div>


