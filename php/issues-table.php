<table>
  <thead>
    <tr>
         <th scope="col"><?= "Title" ?></th>
         <th scope="col"><?= "Type"?></th>
         <th scope="col"><?= "Status" ?></th>
         <th scope="col"><?= "AssignedTo" ?></th>
         <th scope="col"><?= "Created" ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($issue_table as $issue_row): ?>
      <tr>
        <td><?= $issue_row['title']; ?></td> 
        <td><?= $issue_row['type']; ?></td> 
        <td><?= $issue_row['status']; ?></td>  
        <td><?= $issue_row['assigned_to']; ?></td>
        <td><?= $issue_row['created']; ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>