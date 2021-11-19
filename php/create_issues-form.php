<div> 
  <h1>Create Issue</h1>
  <form id="create-issue-form" method="post">
      <div>
          <label for="title">Title</label>
          <input type="text" name="title" id="title"/>
      </div>
      <div>
          <label for="description">Lastname</label>
          <textarea name="description" id="description" cols="30" rows="10"></textarea>
      </div>
      <div>
          <label for="users">Assigned To</label>
          <select name="users" id="users"></select>
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
      <button type="submit" class="add-user-btn">Submit</button>
  </form>
</div>