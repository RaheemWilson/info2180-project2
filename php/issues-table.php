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

<!-- rgb(27,106,201)
rgb(45,165,98) -->